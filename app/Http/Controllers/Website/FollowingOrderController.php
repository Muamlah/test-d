<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\FollowingOrder\Store;
use App\Http\Requests\Website\FollowingOrder\StorePublic;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\User;
use App\Notifications\PrivateOrderNotify;
use App\Traits\GrupoTrait;
use App\Traits\SMSTrait;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException as AuthorizationExceptionAlias;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Traits\CommonTrait;
use App\Traits\FeesTrait;
use App\Notifications\FollowingOrderNotify;
use App\Models\Admin;
use App\Notifications\SendEmailToAdmins;
use Throwable;
use App\Traits\UserLogTreat;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SendCustomEmailsToAdmins;

/**
 * Class FollowingOrderController
 * @package App\Http\Controllers\Website
 */
class FollowingOrderController extends Controller
{
    use GrupoTrait;
    use SMSTrait;
    use CommonTrait, FeesTrait;
    use UserLogTreat;

    /**
     * @param PrivateOrder $privateOrder
     * @return ApplicationAlias|FactoryAlias|ViewAlias
     * @throws AuthorizationExceptionAlias
     */
    public function create(PrivateOrder $privateOrder): ViewAlias
    {
        $this->authorize('createFollowingOrder', $privateOrder);
        $this->data['order'] = $privateOrder;
        return view('website.following_order.create', $this->data);
    }

    /**
     * @param PrivateOrder $privateOrder
     * @return ApplicationAlias|FactoryAlias|ViewAlias
     * @throws AuthorizationExceptionAlias
     */
    public function createWithoutLogin(): ViewAlias
    {
        return view('website.following_order.create_without_login');
    }

    public function createPublic(PublicOrder $publicOrder)
    {
        //  $this->authorize('createFollowingOrder', $publicOrder);
        if (auth()->user()->level == 'user') {
            return redirect()->route('website.settings');
        } else {
            if (auth()->user()->id != $publicOrder->provider_id) {
                return redirect()->route('website.settings');
            }
        }

        $this->data['order'] = $publicOrder;
        return view('website.following_order.createPublic', $this->data);
    }

//    public function store(Store $request)
//    {
//        try {
//
//        } catch (Throwable $throwable) {
//            throw $throwable;
//        }
//
//    }

//    public function list() {
//        $followingOrder = PrivateOrder::all();
//        return view('website.following_order.list' , compact('followingOrder'));
//    }
//
//    public function details($id) {
//
//        $followingOrder = PrivateOrder::findorfail($id);
//        return view('website/following_order/order',compact('followingOrder'));
//
//    }
//
//    public function index()
//    {
//        $followingOrder = PrivateOrder::all(); // Select
//        return view('admin.following_order.list' , compact('followingOrder')); // while query
//    }
//
//
//    public function create()
//    {
//
//        return view('admin.followingOrder.create');
//    }
//
//
    /**
     * @param Store $request
     * @return ApplicationAlias|RedirectResponse|Redirector
     */
    public function store(Store $request)
    {
        $provider = User::where('phone', $request->service_provider_phone)->first();
        if (!empty($provider) && $provider->work_status == 'offline') {
            return back()->with(['error' => 'عذراً.. مزود الخدمة المختار غير متاح حالياً']);
        }
        $order = PrivateOrder::find($request->id);
        $this->authorize('createFollowingOrder', $order);

        // $checkOrder = PrivateOrder::where('parent_order',$request->id)->where('status','!=','confirm_canceled')->first();
        $checkOrder = PrivateOrder::where('parent_order', $request->id)->where('status_id', '!=', 7)->first();
        $deadline = Carbon::parse($request->date . ' ' . '00:00:00');

        if ($deadline < Carbon::now()->format('Y-m-d H:i')) {
            return redirect(route('followingOrder.create', $request->id))->with('error', 'لا يمكنك اختيار تاريخ اقل من تاريخ اليوم');
        }

        if ($order->deadline < $deadline) {
            return redirect(route('followingOrder.create', $request->id))
                ->with('error', 'الرجاء اختيار تاريخ اقل من ' . $order->deadline . ''); // send id of inserted
        }
        if ($order->payable_service_provider < $request->price) {
            return redirect(route('followingOrder.create', $request->id))
                ->with('error', 'الرجاء اختيار قيمة تعميد اقل من ' . $order->price . ''); // send id of inserted
        }
        if (PrivateOrder::where('master_order', $order->master_order)->where('service_provider_phone', $request->service_provider_phone)->count() > 0) {
            return redirect(route('followingOrder.create', $request->id))
                ->with('error', 'تم إسناد التعميد التابع لهذا الرقم سابقاً'); // send id of inserted
        }
        // if($order->status != 'processing') {
        if ($order->status_id != 3) {
            return redirect(route('followingOrder.create', $request->id))
                ->with('error', 'يجب أن يكون الطلب قيد التنفيذ'); // send id of inserted
        }

        if ($order->provider->phone == $request->service_provider_phone) {
            return redirect(route('followingOrder.create', $request->id))
                ->with('error', 'رقم هاتف مقدم الخدمة هو نفسه رقم مقدم الخدمة الأساسي'); // send id of inserted
        }
        $newOrder = new PrivateOrder();

        $check_user_type = User::where('phone', $request->service_provider_phone)->first();
        if (empty($check_user_type)) {
            $creat_provider = $this->addNewUser($request->service_provider_phone, 'provider', $request->price, true);
            $newOrder->provider_id = $creat_provider->id;
        } else {
            if ($check_user_type->level != 'provider') {
                return redirect(route('followingOrder.create', $request->id))
                    ->with('error', 'يمكنك فقط انشاء تعميد تابع لمقدم خدمة!'); // send id of inserted
            }
            $newOrder->provider_id = $check_user_type->id;
        }

        if ($checkOrder == null) {
            $user = auth()->user();
            $check = PrivateOrder::where('master_order', $order->master_order)->count();
            if ($order->followingOrders()->count() < 5) {
                $newOrder->user_id = $user->id;
                $newOrder->user_phone = $user->phone;
                $newOrder->service_provider_phone = $request->service_provider_phone;
                $newOrder->master_order = $order->master_order;
                $newOrder->deadline = $deadline;
                $newOrder->details = $request->details;
                $newOrder->price = $request->price;
                $newOrder->payable_service_provider = $request->price;
                $newOrder->total_amount = $request->price;
                $newOrder->status_id = 2;
                $newOrder->pay_status = $order->pay_status;
                $newOrder->payment_gateway_checkout_data = $order->payment_gateway_checkout_data;
                $newOrder->payment_status = $order->payment_status;
                $newOrder->parent_order = $request->id;
                $newOrder->master_order = $order->master_order;
                $newOrder->save();
                // create User in Grupo
                $userNotify = User::where('id', $newOrder->provider_id)->first();
                $userNotify->notify(new PrivateOrderNotify($newOrder));
            } else {
                return redirect(route('followingOrder.create', $request->id))->with('error', 'لا يسمح بعدد توابع أكثر من 4'); // send id of inserted
            }

            $admins = Admin::get();
            $message1 = 'طلب تعميد تابع';
            $message2 = ' تم اضافة التعميد التابع رقم ' . '#' . $request->id;
            $link = route('followingOrder.create', $request->id);
            foreach ($admins as $admin) {
                $this->sendEmail($message1, $message2, $admin->email);
            }
            $this->AddUserLog(auth()->user(), $message1, $message2, $request->price);
            return redirect(route('followingOrder.create', $request->id))->with('success', 'تم اضافة التعميد التابع بنجاح'); // send id of inserted
        } else {
            return redirect(route('followingOrder.create', $request->id))
                ->with('error', 'التعميد التابع موجود مسبقا'); // send id of inserted
        }
    }

    /**
     * @param Store $request
     * @return ApplicationAlias|RedirectResponse|Redirector
     */
    public function storeWithoutLogin(Request $request)
    {
        try {
            $order = PrivateOrder::where([
                ['id', '=', $request->order_number],
                ['user_phone', '=', $request->user_phone]
            ])->first();

            if (empty($order)) {

                return back()->with(['error' => 'الرجاء التحقق من المعلومات التعميد']);
            }

            $checkOrder = PrivateOrder::where('parent_order', $order->id)->where('status_id', '!=', 7)->first();
            $deadline = Carbon::parse($request->date . ' ' . '23:59:00');

            if ($deadline < Carbon::now()->format('Y-m-d H:i')) {
                return back()->with('error', 'لا يمكنك اختيار تاريخ اقل من تاريخ اليوم');
            }

            if ($order->deadline < $deadline) {
                return back()->with('error', 'الرجاء اختيار تاريخ اقل من ' . $order->deadline . ''); // send id of inserted
            }
            if ($order->payable_service_provider < $request->price) {
                return back()->with('error', 'الرجاء اختيار قيمة تعميد اقل من ' . $order->price . ''); // send id of inserted
            }
            if (PrivateOrder::where('master_order', $order->master_order)->where('service_provider_phone', $request->service_provider_phone)->count() > 0) {
                return back()->with('error', 'تم إسناد التعميد التابع لهذا الرقم سابقاً'); // send id of inserted
            }
            // if($order->status != 'processing') {
            if ($order->status_id != 3) {
                return back()->with('error', 'يجب أن يكون الطلب قيد التنفيذ'); // send id of inserted
            }

            if ($order->provider->phone == $request->service_provider_phone) {
                return back()->with('error', 'رقم هاتف مقدم الخدمة هو نفسه رقم مقدم الخدمة الأساسي'); // send id of inserted
            }
            $newOrder = new PrivateOrder();
            $check_user_type = User::where('phone', $request->service_provider_phone)->first();
            if (empty($check_user_type)) {
                $creat_provider = $this->addNewUser($request->service_provider_phone, 'provider', $request->price, true);
                $newOrder->provider_id = $creat_provider->id;
            } else {
                if ($check_user_type->level != 'provider') {
                    return back()->with('error', 'يمكنك فقط انشاء تعميد تابع لمقدم خدمة!'); // send id of inserted
                }
                $newOrder->provider_id = $check_user_type->id;
            }
            DB::beginTransaction();
            if ($checkOrder == null) {
                $user = $order->user;
                if ($order->followingOrders()->count() < 2) {
                    $newOrder->user_id = $user->id;
                    $newOrder->user_phone = $user->phone;
                    $newOrder->service_provider_phone = $request->service_provider_phone;
                    $newOrder->master_order = $order->master_order;
                    $newOrder->deadline = $deadline;
                    $newOrder->details = $request->details;
                    $newOrder->price = $request->price;
                    $newOrder->payable_service_provider = $request->price;
                    $newOrder->total_amount = $request->price;
                    $newOrder->status_id = 2;
                    $newOrder->pay_status = $order->pay_status;
                    $newOrder->payment_gateway_checkout_data = $order->payment_gateway_checkout_data;
                    $newOrder->payment_status = $order->payment_status;
                    $newOrder->parent_order = $order->id;
                    $newOrder->master_order = $order->master_order;
                    $newOrder->save();
                    $userNotify = User::where('id', $newOrder->provider_id)->first();
                    $userNotify->notify(new PrivateOrderNotify($newOrder));
                } else {
                    return back()->with('error', 'لا يسمح بعدد توابع أكثر من تابع واحد'); // send id of inserted
                }

                $admins = Admin::get();
                $message1 = 'طلب تعميد تابع';
                $message2 = ' تم اضافة التعميد التابع رقم ' . '#' . $order->id;
                $link = '';
                // Notification::send($admins, new SendEmailToAdmins($message1,$message2,$link,$message2));
                foreach ($admins as $admin) {
                    $this->sendEmail($message1, $message2, $admin->email);
                }
                $this->AddUserLog($user, $message1, $message2, $request->price);
                DB::commit();
                return back()->with('success', 'تم اضافة التعميد التابع بنجاح'); // send id of inserted
            } else {
                return back()->with('error', 'التعميد التابع موجود مسبقا'); // send id of inserted
            }

        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

    public function sendEmail($message1, $message2, $email)
    {

        $info = [
            'message1' => $message1,
            'message2' => $message2,
        ];

        Mail::to($email)->send(new SendCustomEmailsToAdmins($info));
    }

    public function storePublic(StorePublic $request)
    {
        $order = PublicOrder::find($request->id);
        $checkOrder = PublicOrder::where('parent_order', $request->id)->where('status', '!=', 7)->first();
        $deadline = Carbon::parse($request->date . ' ' . '00:00:00');
        $user = auth()->user();

        if ($user->level != 'provider') {
            return redirect(route('followingOrder.createPublic', $request->id))
                ->with('error', 'ليس لديك صلاحية'); // send id of inserted
        }
        if ($deadline < Carbon::now()->format('Y-m-d H:i')) {
            return redirect(route('followingOrder.createPublic', $request->id))->with('error', 'لا يمكنك اختيار تاريخ اقل من تاريخ اليوم');
        }

        if ($order->deadline < $deadline) {

            return redirect(route('followingOrder.createPublic', $request->id))
                ->with('error', 'الرجاء اختيار تاريخ اقل من ' . $order->deadline . ''); // send id of inserted
        }

        if ($order->payable_service_provider < $request->price) {
            return redirect(route('followingOrder.createPublic', $request->id))
                ->with('error', 'الرجاء اختيار قيمة تعميد اقل من ' . $order->price . ''); // send id of inserted
        }

        if ($order->provider->phone == $request->service_provider_phone) {

            return redirect(route('followingOrder.createPublic', $request->id))
                ->with('error', 'رقم هاتف مقدم الخدمة هو نفسه رقم مقدم الخدمة الأساسي'); // send id of inserted
        }

        if ($order->status != 3) {
            return redirect(route('followingOrder.createPublic', $request->id))
                ->with('error', 'يجب أن يكون الطلب قيد التنفيذ'); // send id of inserted
        }

        if ($checkOrder == null) {
            $check = PublicOrder::where('master_order', $order->master_order)->count();

            if ($order->followingOrders()->count() < 2) {
                $checkProvider = User::where('phone', $request->service_provider_phone)->first();
                if (!$checkProvider) {
                    $password = rand(1000, 9999);
                    $newUser = new User();
                    $newUser->phone = $request->service_provider_phone;
                    $newUser->level = 'provider';
                    $newUser->active = 0;
                    $newUser->verification_code = rand(1000, 9999);
                    $newUser->password = bcrypt($password);
                    $newUser->save();
                    $this->createUser($request->service_provider_phone, $password);
                    $url = 'https://app.muamlah.com/';
                    $msg = "عزيزي مقدم الخدمة" . "\n" . "لديك طلب تعميد بقيمة #" . " " . $order->price . "ريال" . "\n" .
                        " اذا لم تكن مسجل يمكنك استخدام الرمز لتفعيل حسابك تلقائيا على الرابط التالي" . " " . $url . "\n" . "رمز التفعيل :" . $user->verification_code . "\n" .
                        "كلمة المرور :" . $password;

                    $this->sendSMS($request->service_provider_phone, $msg);
                } else {
                    if ($checkProvider->level != 'provider') {
                        return redirect(route('followingOrder.createPublic', $request->id))
                            ->with('error', 'يجب أن يكون رقم الهاتف تابع لمزود خدمة'); // send id of inserted
                    }
                    $newUser = $checkProvider;
                }
                if (PublicOrder::where('master_order', $order->master_order)->where('provider_id', $newUser->id)->count() > 0) {
                    return redirect(route('followingOrder.createPublic', $request->id))
                        ->with('error', 'تم إسناد التعميد التابع لهذا الطلب لنفس المزود سابقاً'); // send id of inserted
                }
                $newOrder = new PublicOrder();
                $newOrder->user_id = $user->id;
                $newOrder->provider_id = $newUser->id;
                $newOrder->title = $order->title;
                $newOrder->fees = 0;
                $newOrder->value_added_tax = 0;
                $newOrder->deadline = $deadline;
                $newOrder->details = $request->details;
                $newOrder->price = $request->price;
                $newOrder->total_amount = $request->price;
                $newOrder->payable_service_provider = $request->price;
                $newOrder->status = 3;
                $newOrder->pay_status = $order->pay_status;
                $newOrder->payment_gateway_checkout_data = $order->payment_gateway_checkout_data;
                $newOrder->payment_status = $order->payment_status;
                $newOrder->parent_order = $request->id;
                $newOrder->master_order = $order->master_order;
                $newOrder->save();


            } else {
                return redirect(route('followingOrder.createPublic', $request->id))->with('error', 'لا يسمح بعدد توابع أكثر من تابع واحد'); // send id of inserted
            }

            Notification::send($newUser, new FollowingOrderNotify($newOrder, 'order_added_to_existing_provider', route('publicService.show', $newOrder->id)));

            return redirect(route('followingOrder.createPublic', $request->id))->with('success', 'تم اضافة التعميد التابع بنجاح'); // send id of inserted
        } else {
            return redirect(route('followingOrder.createPublic', $request->id))
                ->with('error', 'التعميد التابع موجود مسبقا'); // send id of inserted
        }
    }


}
