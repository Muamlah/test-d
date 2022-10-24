<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateOrder\PrivateOrderCollection;
use App\Http\Resources\PrivateOrder\TransactionCollection;

use App\Models\Fees;
use App\Models\User;
use App\Notifications\StatusUpdatePrivateOrderNotify;
use App\Traits\ARBPaymentGatewayTrait;
use App\Traits\CommonTrait;
use App\Traits\FeesTrait;
use App\Traits\GrupoTrait;
use App\Traits\PaymentGatewayTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use \App\Models\PrivateOrder;
use \App\Models\Transaction;
use \App\Models\Status;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Throwable;

class PrivateOrderAdminController extends Controller
{
    use FeesTrait;
    use CommonTrait;

    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE

        $this->middleware('auth:admin');
        $this->middleware('canPermission:READ_TRANSACTIONS', ['only' => ['transactions']]);
        $this->middleware('canPermission:READ_PRIVATE_ORDER', ['only' => ['list', 'get_all']]);
        $this->middleware('canPermission:UPDATE_PRIVATE_ORDER', ['only' => ['edit', 'update']]);

    }


    public function transactions()
    {
        // $transactions = Transaction::all();
        return view('admin.transactions.list');
    }

    public function get_all_transactions(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'asc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = Transaction::whereNotNull('id');

        if ($request->input('query.date_from') != null) {
            $query->where('created_at', '>=', $request->input('query.date_from'));
        }

        if ($request->input('query.date_to') != null) {
            $query->where('created_at', '<=', $request->input('query.date_to'));
        }

        if ($request->input('query.phone') != null) {
            $query->whereHas('user', function ($q) use ($request) {
                return $q->where('phone', 'like', "%" . $request->input('query.phone') . "%");
            });
        }

        if ($request->input('query.name') != null) {
            $query->whereHas('user', function ($q) use ($request) {
                return $q->where('name', 'like', "%" . $request->input('query.name') . "%");
            });
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy('id', 'DESC');
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / 50));
        $request->offsetSet('total', $totalCount);
        return (new TransactionCollection($data));
    }

    public function list()
    {
        // $privateOrders = privateOrder::all();
        $status = Status::where('status', '!=', 'refuse')->get();
        $all_status = PrivateOrder::whereNotNull('id')->orderBy('id', 'DESC')->select('status_id')->get();
        $pending = clone $all_status->where('status_id', 1);
        $waiting = clone $all_status->where('status_id', 2);
        $processing = clone $all_status->where('status_id', 3);
        $completed = clone $all_status->where('status_id', 4);
        $confirm_completed = clone $all_status->where('status_id', 5);
        $canceled = clone $all_status->where('status_id', 6);
        $confirm_canceled = clone $all_status->where('status_id', 7);
        $report = clone $all_status->where('status_id', 8);
        $whatsapp = clone $all_status->where('status_id', 11);

        return view('admin.private_orders.list', compact('status', 'pending','whatsapp', 'waiting', 'processing', 'completed', 'confirm_completed', 'canceled', 'confirm_canceled', 'report'));
    }

    public function followingPrivateOrders($order_id)
    {
        // $privateOrders = privateOrder::all();
        $status = Status::get();
        return view('admin.private_orders.following_list', compact('status', 'order_id'));
    }
    public function followingPrivateOrdersEdit(PrivateOrder $order)
    {
        if (!can('UPDATE_PRIVATE_ORDER')) {
            return abort(404);
        }
        $status = Status::query();
        if (!can('COMPLETED_ORDERS')) {
            $status = $status->where('status', '!=', 'confirm_completed');
        }
        if (!can('CANCELED_ORDERS')) {
            $status = $status->where('status', '!=', 'confirm_canceled');
        }
        $status = $status->get();

        return view('admin.private_orders.following-edit', compact('order', 'status'));
    }

    public function get_all_following(Request $request)
    {
        $master_id = PrivateOrder::where('id', $request->order_id)->first()->master_order;

        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'asc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        // $query = PrivateOrder::where('master_order',$request->order_id)->orderBy('id', 'DESC');
        $query = PrivateOrder::where('master_order', $master_id);
        // dd($request->all());

        if ($request->input('query.status_id') != null) {
            $query->where('status_id', $request->input('query.status_id'));
        }
        if ($request->input('query.all_status') != null && $request->input('query.all_status') != 'all') {
            $query->where('status_id', $request->input('query.all_status'));
        }
        if ($request->input('query.pay_status') != null) {
            $query->where('pay_status', $request->input('query.pay_status'));
        }
        if ($request->input('query.amount_from') != null) {
            $query->where('price', '>=', $request->input('query.amount_from'));
        }

        if ($request->input('query.amount_to') != null) {
            $query->where('price', '<=', $request->input('query.amount_to'));
        }

        if ($request->input('query.date_from') != null) {
            $query->where('created_at', '>=', $request->input('query.date_from'));
        }

        if ($request->input('query.date_to') != null) {
            $query->where('created_at', '<=', $request->input('query.date_to'));
        }


        if ($request->input('query.phone') != null) {
            $query->whereHas('user', function ($q) use ($request) {
                return $q->where('phone', 'like', "%" . $request->input('query.phone') . "%");
            })->orWhereHas('provider', function ($q) use ($request) {
                return $q->where('phone', 'like', "%" . $request->input('query.phone') . "%");
            });
        }

        $query->where('master_order', $master_id);

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / 50));
        $request->offsetSet('total', $totalCount);
        return (new PrivateOrderCollection($data));
    }


    public function get_all(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'asc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = PrivateOrder::whereNotNull('id');
        // dd($request->all());
        if ($request->input('query.status_id') != null) {
            $query->where('status_id', $request->input('query.status_id'));
        }
        if ($request->input('query.all_status') != null && $request->input('query.all_status') != 'all') {
            $query->where('status_id', $request->input('query.all_status'));
        }
        if ($request->input('query.pay_status') != null) {
            $query->where('pay_status', $request->input('query.pay_status'));
        }
        if ($request->input('query.amount_from') != null) {
            $query->where('price', '>=', $request->input('query.amount_from'));
        }

        if ($request->input('query.amount_to') != null) {
            $query->where('price', '<=', $request->input('query.amount_to'));
        }

        if ($request->input('query.date_from') != null) {
            $query->where('created_at', '>=', $request->input('query.date_from'));
        }

        if ($request->input('query.date_to') != null) {
            $query->where('created_at', '<=', $request->input('query.date_to'));
        }

        if ($request->input('query.order_number') != null) {
            $query->where('id', $request->input('query.order_number'));
        }

        if ($request->input('query.phone') != null) {
            $query->whereHas('user', function ($q) use ($request) {
                return $q->where('phone', 'like', "%" . $request->input('query.phone') . "%");
            })->orWhereHas('provider', function ($q) use ($request) {
                return $q->where('phone', 'like', "%" . $request->input('query.phone') . "%");
            });
        }

        // if ( $request->input('query.provider_phone')!=null ) {
        //     $query->whereHas('provider', function($q) use ($request){
        //         $q->where('level', 'provider')->where('phone','like', "%" . $request->input('query.provider_phone') . "%");
        //     });
        // }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / 50));
        $request->offsetSet('total', $totalCount);
        return (new PrivateOrderCollection($data));
    }


    public function details($id)
    {

        $privateOrder = privateOrder::findorfail($id);
        return view('website/privateOrder/details', compact('privateOrder'));

    }

    public function index()
    {
        $privateOrder = privateOrder::all(); // Select
        return view('admin.privateOrder.list', compact('privateOrder')); // while query
    }


    public function create()
    {

        return view('admin.privateOrder.create');
    }


    public function store()
    {


        $slider = PrivateOrder::create($this->validateData()); // insert
        $this->storeImage($slider);
        return redirect('/admin/privateOrder/create')->with("success", "Created Successfully"); // send id of inserted

    }

    public function show(PrivateOrder $privateOrder)
    {
        //
    }


    public function edit(PrivateOrder $order)
    {
        if (!can('UPDATE_PRIVATE_ORDER')) {
            return abort(404);
        }
        $status = Status::query();
        if (!can('COMPLETED_ORDERS')) {
            $status = $status->where('status', '!=', 'confirm_completed');
        }
        if (!can('CANCELED_ORDERS')) {
            $status = $status->where('status', '!=', 'confirm_canceled');
        }
        $status = $status->get();

        return view('admin.private_orders.edit', compact('order', 'status'));
    }


    /**
     * @param Request $request
     * @param PrivateOrder $order
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, PrivateOrder $order)
    {
        try {

            if ($order->verify == 'yes') {
                abort(403);
            }
            $status = Status::find(request()->input('status_id'));
            if ($status->status == 'confirm_completed') {
                if (!can('COMPLETED_ORDERS')) {
                    abort(403);
                }
            }
            if ($status->status == 'confirm_canceled') {
                if (!can('CANCELED_ORDERS')) {
                    abort(403);
                }
            }
            $order->status_id = request()->input('status_id');
            $description = '
            تم تعديل حالة طلب تعميد خاص رقم ' . $order->id . '
            إلى الحالة
            ' . Status::find($request->status_id)->name . '
        ';
            $this->addLog('تعديل حالة طلب تعميد خاص', $description);
            $update_price = $order->instanceOrders()->where('payment_status', true)->sum('update_price');

            if ($order->status_id == 7 || $order->status_id == 5) {
                $verify = 'yes';
            } else {
                $verify = 'no';
            }
            if ($order->status_id == 7 || $order->status_id == 9) {
                $fees = Fees::first();
                $user = User::find($order->user_id);
                $this->userBalance($user, false, $order->total_amount, $fees->service_cancellation);
                $this->newTransaction($user->id, ($order->total_amount - $fees->service_cancellation), $order->id, 'private', 'deposit', "ايداع رصيد تعميد رقم $order->id ");
                $this->walletMuamlah($fees->service_cancellation, $order->price, $order->id, 'private', 'deposit', "رسوم الغاء طلب تعميد رقم $order->id");
                PrivateOrder::where('master_order', $order->master_order)->update(['status_id' => $order->status_id, 'verify' => $verify]);
            } elseif ($order->status_id == 5 || $order->status_id == 10) {
                $item = $order;
                $user = User::where('id', $item->user_id)->first();
                $provider = User::where('id', $item->provider_id)->first();
                DB::beginTransaction();
                $offerData = [
                    'message' => "تم استلام  طلب التعميد خاص رقم $item->id من طرف العميل ",
                    'link' => route('privateService.show', $item->id),
                ];
                Notification::send($provider, new StatusUpdatePrivateOrderNotify($item, $offerData));
                $data = PrivateOrder::where('master_order', $item->master_order)->get();
                foreach ($data as $key => $value) {
                    $order_provider = User::where('id', $value->provider_id)->first();
                    $order_user = User::find($value->user_id);
                    $amount = $value->payable_service_provider;
                    if ($value->parent_order == 0) {
                        $total_amount = $value->payable_service_provider + ($item->provider_value_added_tax + $item->provider_fees);
                        if ($update_price != 0) {
                            $this->newTransaction($value->user_id, $total_amount, $value->id, 'private', 'withdrawal', "سحب رسوم تعديل تعميد خاص رقم $value->id ");
                            $this->userBalanceDiscount($user, $update_price);
                        }
                    } else {
                        $total_amount = $value->payable_service_provider;
                    }
                    $total_amount += $value->agent_per;
                    if (!is_null($value->payment_status)) {
                        $this->newTransaction($value->user_id, $total_amount, $value->id, 'private', 'withdrawal', "سحب رسوم تعميد خاص رقم $value->id ");
                    }
                    if ($value->parent_order == 0) {
                        $this->userBalanceDiscount($user, $total_amount);
                        if ($value->total_amount - $total_amount != 0) {
                            $this->ReturnRestToBalance($user, ($value->total_amount - $total_amount));
                            $this->newTransaction($user->id, ($value->total_amount - $total_amount), $item->id, 'private', 'deposit', " ايداع رصيد فرق  تعميد خاص  رقم $item->id");
                        }
                    } else {
                        $this->providerBalanceDiscount($order_user, $total_amount);
                    }
                    $this->newTransaction($order_provider->id, $amount, $value->id, 'private', 'deposit', "ايداع رصيد تعميد رقم $value->id ");
                    $this->providerBalance($order_provider, $amount);
                }
                $this->walletMuamlah(($item->provider_value_added_tax + $item->provider_fees + $update_price), $item->price, $item->id, 'private', 'deposit', "ايداع عمولة تعميد رقم $item->id ");
                PrivateOrder::where('master_order', $item->master_order)->update(['status_id' => $order->status_id, 'verify' => 'yes']);
                $instance = $item->coupone_instance;
                if (!is_null($instance) && $instance->owner_discount != 0) {
                    $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', " تم شحن الرصيد باستخدام كود الحسم" . $instance->code . "للطلب رقم: " . $item->id);
                    $this->walletMuamlah($instance->owner_discount, $item->price, $item->id, 'private', 'withdrawal', "سحب عمولة كوبون على تعميد خاص رقم $item->id ");
                    $this->providerBalance($instance->owner, $instance->owner_discount);
                }
                if (!is_null($agent = $item->agent)) {
                    $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit', " ايداع رصيد عمولة طلب تعميد خاص  رقم $item->id");
                    $this->providerBalance($agent, $item->agent_per);

                }
                DB::commit();
            } else {
                PrivateOrder::where('master_order', $order->master_order)->update(['status_id' => $order->status_id, 'verify' => $verify]);
            }
            return redirect('/admin/private_orders/' . $order->id)->with('success', 'تم التحديث بنجاح');
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }
    public function updateFollowing(Request $request, PrivateOrder $order)
    {
        try {

            if ($order->verify == 'yes') {
                abort(403);
            }

            $description = '
            تم تعديل حالة  تعميد خاص رقم ' . $order->id . '
         ';
            $this->addLog('تعديل حالة طلب تعميد خاص', $description);
            $order->price=$request->price;
            $order->fees=$request->fees;
            $order->value_added_tax=$request->value_added_tax;
            $order->payable_service_provider=$request->payable_service_provider;
            $order->provider_fees=$request->provider_fees;
            $order->provider_value_added_tax=$request->provider_value_added_tax;
            $order->update();
                DB::commit();
            return redirect('/admin/following_private_orders/' . $order->id)->with('success', 'تم التحديث بنجاح');

        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }


    public function destroy(PrivateOrder $order)
    {

        $order->delete();
        return redirect('/admin/privateOrder');
    }


    protected function validateData()
    {


        $mydata = [
            'user_phone' => 'required',
            'service_provider_phone' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'details' => 'required',
            'status' => 'required',
        ];


        $validatedData = request()->validate($mydata);


        return $validatedData;


    }

}
