<?php

namespace App\Http\Controllers\Website;


use App\Models\Admin;
use App\Models\Fees;
use App\Models\PrivateOrder;
use App\Models\eservices_orders;
use App\Models\PublicOrder;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\PrivateOrderNotify;
use App\Notifications\ReportToPrivateOrderNotify;
use App\Notifications\StatusUpdatePrivateOrderNotify;
use App\Traits\CommonTrait;
use App\Traits\FeesTrait;
use App\Traits\UserLogTreat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use Throwable;
use Auth;
use App\Notifications\ChangeStatusNotify;
use App\Models\Message;
use App\Models\Coupon;
use App\Models\CouponInstance;

/**
 * Class SettingsController
 * @package App\Http\Controllers\Website
 */
class PrivateServiceController extends Controller
{

    use CommonTrait;
    use FeesTrait;
    use UserLogTreat;

    /**
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $this->data['items'] = PrivateOrder::where('provider_id', Auth::user()->id)
            ->where('pay_status', 'complete_convert')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

        $this->data['publicOrders'] = PublicOrder::where('provider_id', Auth::user()->id)
            ->where('pay_status', 'complete_convert')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

//        $this->data['eservices_orders'] = eservices_orders::where('provider_id', Auth::id())
//            ->where('pay_status', 'complete_convert')
//            ->orderBy('updated_at', 'DESC')
//            ->paginate(10);
        $this->data['orders'] = [];
        return view('website.privateService.index', $this->data);

    }

    public function seeMore()
    {
        // $items = PrivateOrder::where('provider_id', Auth::user()->id)
        //     ->where('pay_status','complete_convert')
        //     ->orderBy('updated_at', 'DESC')
        //     ->paginate(10);
        // $view = view('website.privateService.ajax-view.data',compact('items'))->render();

        $privateOrders = PrivateOrder::with('provider', 'user')->where('provider_id', Auth::user()->id)
            ->where('pay_status', 'complete_convert')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);
//        $publicOrders = PublicOrder::with('provider', 'user')->where('provider_id', Auth::user()->id)
//            ->where('pay_status', 'complete_convert')
//            ->orderBy('updated_at', 'DESC')
//            ->paginate(5);
        $orders = collect([]);
//        foreach ($publicOrders as $order) {
//            $item = new \stdClass;
//            $item->id = $order->id;
//            $item->type = "public";
//            $item->provider_id = !is_null($order->provider) ? $order->provider->id : "";
//            $item->provider_name = !is_null($order->provider) ? $order->provider->name : "";
//            $item->provider_phone = !is_null($order->provider) ? $order->provider->phone : "";
//            $item->user_name = !is_null($order->user) ? $order->user->name : "";
//            $item->user_phone = !is_null($order->user) ? $order->user->phone : "";
//            $item->status_id = $order->status;
//            $item->status_name = $order->statusName();
//            $item->created_at = $order->created_at;
//            $item->formated_created_at = $order->created_at->format('d-m-Y');
//            $orders->push($item);
//        }
        foreach ($privateOrders as $order) {
            $item = new \stdClass;
            $item->id = $order->id;
            $item->type = "private";
            $item->provider_id = !is_null($order->provider) ? $order->provider->id : "";
            $item->provider_name = !is_null($order->provider) ? $order->provider->name : "";
            $item->provider_phone = !is_null($order->provider) ? $order->provider->phone : "";
            $item->user_name = !is_null($order->user) ? $order->user->name : "";
            $item->user_phone = !is_null($order->user) ? $order->user->phone : "";
            $item->status_id = $order->status_id;
            $item->status_name = $order->statusName();
            $item->created_at = $order->created_at;
            $item->formated_created_at = $order->created_at->format('d-m-Y');
            $orders->push($item);
        }
        $orders = $orders->sortByDesc('created_at');
        $view = view('website.privateService.ajax-view.row', compact('orders'))->render();
        return response()->json(['html' => $view]);
    }

    public function seeMorePublic()
    {
        $publicOrders = PublicOrder::where('provider_id', Auth::user()->id)
            ->where('pay_status', 'complete_convert')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

        $view = view('website.privateService.ajax-view.public_data', compact('publicOrders'))->render();
        return response()->json(['html' => $view]);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id): View
    {

        $this->data['item'] = PrivateOrder::findOrFail($id);
        $this->authorize('serviceOwner', $this->data['item']);

        //To Check if it's the last follower or not
        $this->data['row'] = PrivateOrder::where('master_order', $this->data['item']->master_order)
            ->orderBy('id', 'desc')->limit('10')
            ->first();
        $this->data['row_count'] = PrivateOrder::where('master_order', $this->data['item']->master_order)->count();

        $this->data['chat_message'] = $this->data['item']->open_chat();
        return view('website.privateService.show', $this->data);

    }

    /**
     * تغير حالة الخدمة
     * @param $id
     * @param $status
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateStatus($id, $status_id, Request $request): RedirectResponse
    {
        if (auth()->user()->level != 'provider') {
            abort(404);
        }
        // $privateOrder   = PrivateOrder::where('pay_status', 'complete_convert')->where('verify', 'no')->where('id', $id)->first();
        // dd($status_id,$privateOrder->status_id);
        // dd(auth()->user()->level);
        // dd($status_id);

        try {


            $user = auth()->user();
            $phone = $user->phone;
            $password = $request->password;
            if ($status_id == 8) {
                $privateOrder = PrivateOrder::where('pay_status', 'complete_convert')->where('id', $id)->first();
            } else {
                $privateOrder = PrivateOrder::where('pay_status', 'complete_convert')->where('verify', 'no')->where('id', $id)->first();

            }
            $masterPrivateOrder = PrivateOrder::where('master_order', $privateOrder->master_order)->first();
            $message1 = 'تم تعديل طلب تعميد خاص';
            $message2 = ' تعديل طلب تعميد خاص رقم ' . '#' . $privateOrder->id;
            // Notification::send($admins, new SendEmailToAdmins($message1, $message2, $link,$message2));
            $this->AddUserLog($user, $message1, $message2, $request->price);
            $this->authorize('serviceOwner', $privateOrder);
            if ($privateOrder->parent_order == 0) {
                $owner = User::find($privateOrder->user_id);
                $master_order_id = $privateOrder->id;
                $notify_user = !is_null($privateOrder->agent_id) ? $privateOrder->agent : $privateOrder->user;
            } else {
                $master_order = PrivateOrder::where('id', $privateOrder->master_order)->first();
                $owner = User::find($master_order->user_id);
                $master_order_id = $master_order->id;
                $notify_user = !is_null($master_order->agent_id) ? $master_order->agent : $master_order->user;

            }
            if ($status_id == 3) {
                // $privateOrder->status='processing';
                $privateOrder->status_id = 3;
                $privateOrder->update();

                Notification::send($notify_user, new ChangeStatusNotify($privateOrder, '30', 'my-orders/' . $master_order_id . '/show'));
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }
            elseif ($status_id == 4) {
                if ($request->deserved_price != $privateOrder->price) {
                    $admins = Admin::get();
                    PrivateOrder::where('master_order', $privateOrder->master_order)->update(['status_id' => 8]);
                    $message = new Message;
                    $message->user_id = $user ? $user->id : NULL;
                    $message->name = $user->name;
                    $message->subject = "إبلاغ على طلب تعميد خاص رقم :" . $privateOrder->id;
                    $message->email = $user->email;
                    $message->message = "إبلاغ على طلب تعميد خاص رقم :" . $privateOrder->id;;
                    $message->entity_id = $privateOrder->id;
                    $message->entity_type = PrivateOrder::class;
                    $message->save();
                    Notification::send($admins, new ReportToPrivateOrderNotify($privateOrder));
                    $notify_user->notify(new ReportToPrivateOrderNotify($privateOrder));
                    return back()->with(['success' => 'سوف يتم مراجعة الطلب من قبل المشرف وتواصل معك']);
                }
                $fees = $this->CalculateFees($request->deserved_price);
                $has_coupon = false;
                $coupon_discount = 0;
                if (!is_null($instance = $privateOrder->coupone_instance)) {
                    $coupon = Coupon::where('type', 'coupon')->where('id', $instance->coupon_id)->first();
                    $has_coupon = true;
                    $coupon_discount = $this->calculateDiscount($coupon, $fees['fee']);
                    $provider_discount = $this->calculateOwnerDiscount($coupon, $fees['fee']);
                    $instance = CouponInstance::update_instance($instance, $coupon, $coupon_discount, $provider_discount);
                    $fees['fee'] = $fees['fee'] - $coupon_discount;

                }
                $total_amount = (($fees['value_added_tax'] / 100) * $fees['fee']) + $request->deserved_price + $fees['fee'];
                $privateOrder->payable_service_provider = $request->deserved_price;
                $privateOrder->provider_fees = $fees['fee'];
                $privateOrder->provider_value_added_tax = (($fees['value_added_tax'] / 100) * $fees['fee']);
                $privateOrder->update();
                if (!empty($privateOrder->agent_id)) {
                    $privateOrder->agent_per = $this->calculateAgentAmount($total_amount);
                    $privateOrder->save();
                }
                $orders = PrivateOrder::where('master_order', $privateOrder->master_order)->where('parent_order', '!=', 0)->where('id', '!=', $id);
                $orders->update(['status_id' => 5, 'verify' => 'yes']);
                $all_orders = PrivateOrder::whereIn('id', [$id, $privateOrder->master_order]);
                $all_orders->update(['status_id' => 4]);
                $offerData = [
                    'message' => "تم تسليم  طلب التعميد خاص رقم $privateOrder->master_order من طرف مقدم الخدمة ",
                    'link' => route('privateOrder.show', $privateOrder->master_order),
                ];
                Notification::send($notify_user, new StatusUpdatePrivateOrderNotify($privateOrder, $offerData));
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            } elseif ($status_id == 8) {
                $admins = Admin::get();
                $privateOrder->status_id = 8;
                $privateOrder->update();
                $message = new Message;
                $message->user_id = $user ? $user->id : NULL;
                $message->name = $user->name;
                $message->subject = "إبلاغ على طلب تعميد خاص رقم :" . $privateOrder->id;
                $message->email = $user->email;
                $message->message = $request->message;
                $message->entity_id = $privateOrder->id;
                $message->entity_type = PrivateOrder::class;
                $message->save();
                Notification::send($admins, new ReportToPrivateOrderNotify($privateOrder));
                $notify_user->notify(new ReportToPrivateOrderNotify($privateOrder));
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            } elseif ($status_id == 6 && ($privateOrder->status_id == 3 || $privateOrder->status_id == 2)) {
                DB::beginTransaction();
                $fees = Fees::first();
                $this->userBalance($owner, false, $masterPrivateOrder->total_amount, $fees->service_cancellation);
                $this->newTransaction($owner->id, $fees->service_cancellation, $masterPrivateOrder->id, 'private', 'withdrawal', " رسوم الغاء طلب تعميد رقم  $masterPrivateOrder->id ");
                $this->newTransaction($owner->id, ($masterPrivateOrder->total_amount), $masterPrivateOrder->id, 'private', 'deposit', "ايداع رصيد تعميد رقم $masterPrivateOrder->id ");
                PrivateOrder::where('master_order', $privateOrder->master_order)->update(['status_id' => 7, 'cancellation' => 'provider', 'verify' => 'yes']);
                Notification::send($notify_user, new ChangeStatusNotify($privateOrder, '60', 'my-orders/' . $master_order_id . '/show'));

                DB::commit();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            } elseif ($status_id == 7 && $privateOrder->status_id == 6) {

                DB::beginTransaction();
                $fees = Fees::first();
                $this->userBalance($owner, false, $masterPrivateOrder->total_amount, $fees->service_cancellation);
                $this->newTransaction($owner->id, $fees->service_cancellation, $masterPrivateOrder->id, 'private', 'withdrawal', " رسوم الغاء طلب تعميد رقم  $masterPrivateOrder->id ");
                $this->newTransaction($owner->id, ($masterPrivateOrder->total_amount - $fees->service_cancellation), $masterPrivateOrder->id, 'private', 'deposit', "ايداع رسوم الغاء تعميد  رقم $privateOrder->id ");
                $this->walletMuamlah($fees->service_cancellation, $masterPrivateOrder->price, $masterPrivateOrder->id, 'private', 'deposit', "رسوم الغاء طلب تعميد رقم $masterPrivateOrder->id");
                PrivateOrder::where('master_order', $privateOrder->master_order)->update(['status_id' => 7, 'cancellation' => 'user', 'verify' => 'yes']);
                Notification::send($notify_user, new ChangeStatusNotify($privateOrder, '70', 'my-orders/' . $master_order_id . '/show'));
                DB::commit();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

}
