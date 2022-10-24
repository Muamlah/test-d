<?php

namespace App\Http\Controllers\Website;


use App\Models\eservices;
use App\Models\PrivateOrder;
use App\Models\Fees;
use App\Models\eservices_orders;
use App\Models\PublicOrder;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use Throwable;
use Auth;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReceivePublicOrderNotify;
use App\Notifications\FinishPublicOrderNotify;
use App\Models\PublicOrderOffer;
use App\Traits\CommonTrait;
use App\Traits\FeesTrait;
use App\Notifications\StatusUpdatePublicOrderNotify;


/**
 * Class SettingsController
 * @package App\Http\Controllers\Website
 */
class PublicServiceController extends Controller
{
    use CommonTrait, FeesTrait;

    /**
     * @return Application|Factory|View
     */
    public function index(): View
    {


        //            $user->unreadNotifications->markAsRead();
        $this->data['items'] = PrivateOrder::where('service_provider_phone', Auth::user()->phone)->get();

        $this->data['publicOrders'] = PublicOrder::where('provider_id', Auth::user()->id)->get();

        $this->data['eservices_orders'] = eservices_orders::where('provider_id', Auth::id())->get();

        return view('website.privateService.index', $this->data);

    }


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {

        $this->data['item'] = PublicOrder::findOrFail($id);
        $this->data['eservices'] = eservices::find($this->data['item']->eservices_id);

        $this->data['offer'] = PublicOrderOffer::where('order_id', $this->data['item']->id)->where('user_id', $this->data['item']->provider_id)->first();
        // dd($this->data['offer'] , auth()->user()->id);
        //To Check if it's the last follower or not
        $this->data['row'] = PublicOrder::where('master_order', $this->data['item']->master_order)
            ->orderBy('id','desc')->limit('1')
            ->first();

//        if(auth()->user()->level == 'provider'){
            if($this->data['item']->provider_id != auth()->user()->id){
                abort(403);
            }
//        }
        $this->data['chat_message'] = $this->data['item']->open_chat();

        return view('website.myServices.showDetalis', $this->data);

    }

    /**
     * تغير حالة الخدمة
     * @param $id
     * @param $status
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateStatus($id, $status, Request $request)
    {
        try {

            $user = auth()->user();
            $phone = $user->phone;
            $password = $request->password;
            $publicOrder = PublicOrder::findOrFail($id);
            $public = PublicOrder::where('id', $publicOrder->master_order)->first();

//            $provider = User::where('id',$publicOrder->provider_id)->first();
            $order_user = User::where('id',$public->user_id)->first();
            $notify_user = !is_null($public->agent_id) ? $public->agent : $public->user;
            if ($status == 2) {
                $publicOrder->status=3;
                $publicOrder->update();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }
            elseif ($status == 3) {
                // $publicOrder->status=4;
                $fees = $this->CalculatePublicOrderFees($request->deserved_price);
                if( $publicOrder->followingOrdersCount() == 1) {
                    $price = $publicOrder->price;
                } else{
                    $price = $publicOrder->payable_service_provider;
                }
                if($price == $request->deserved_price){
                    $publicOrder->payable_service_provider=round((double)$request->deserved_price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax']  , 2);
                    $publicOrder->update();
                }elseif($price > $request->deserved_price){
//                    DB::beginTransaction();
                    $offer = PublicOrderOffer::where('order_id', $publicOrder->master_order)->where('user_id', $publicOrder->provider_id)->first();
//                    $request->price = $request->deserved_price;
                    $fee = [
                        'fee' =>  round($fees['offer_fee'] , 2) ,
                        'tax_amount' => round($fees['offer_added_tax'] , 2) ,
                        'deserved_price' => round((double)$request->deserved_price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax']  , 2),
                    ];

                    if (!is_null($offer)) {
//                        $fees                                       = $this->CalculatePublicOrderFees($request->deserved_price);
                        $payable_service_provider     = $fee['deserved_price'];
                        $provider_fees                = $fee['fee'];
                        $provider_value_added_tax     =$fees['offer_added_tax'];
                        $offer->price=$request->deserved_price;
                        $offer->fees=$fee['fee'];
                        $offer->tax_amount=$fee['tax_amount'];
                        $offer->deserved_price=$fee['deserved_price'];
                        $offer->value_added_tax=$fees['offer_added_tax'];
                        $offer->save();
                    }else{
                        $payable_service_provider     = $request->deserved_price;
                        $provider_fees                = 0;
                        $provider_value_added_tax     = 0;
                    }
                    $total_amount = $fees['order_fee'] + $fees['order_added_tax'] + (double)  $request->deserved_price;
                    $publicOrder->update([
                        'fees' => $fees['order_fee'],
                        'value_added_tax' => $fees['order_added_tax'],
                        'deserved_price' =>  $total_amount,
                        'provider_fees' =>  $provider_fees,
                        'payable_service_provider' =>  $payable_service_provider,
                        'provider_value_added_tax' =>  $provider_value_added_tax,
                    ]);
                    if(!empty($publicOrder->agent_id))
                    {
                        $publicOrder->agent_per = $this->calculateAgentAmount($total_amount);
                        $publicOrder->save();
                    }
                    DB::commit();
                }else{
                    return back()->with(['error' => 'الرقم المدخل يجب أن يكون أقل أو يساوي قيمة العرض']);
                }
                //
                $orders = PublicOrder::where('master_order',$publicOrder->master_order)->where('parent_order','!=',0)->where('id','!=',$id);
                $orders->update(['status' => 5]);

                $all_orders = PublicOrder::whereIn('id',[$id,$publicOrder->master_order]);
                $all_orders->update(['status' => 4]);

                Notification::send($notify_user, new ReceivePublicOrderNotify($public));

                return back()->with(['success' => 'تمت العملية بنجاح !']);

            }
            elseif ($status == 4) {
                if ($request->code && $request->code == $publicOrder->verify_code) {
                    $publicOrder->status=5;
                    $publicOrder->update();
                    return back()->with(['success' => 'تم تأكيد استلام الطلب !']);
                } elseif ($request->password && Auth::attempt(['phone' => $phone, 'password' => $password])) {
                    $publicOrder->status=5;
                    $publicOrder->update();
                    return back()->with(['success' => 'تم تأكيد استلام الطلب !']);
                } else {
                    return back()->with(['error' => 'كلمة المرور او رمز التحقق المدخل خاطيء !']);
                }
            }
            elseif ($status == 6) {
                DB::beginTransaction();
//                $publicOrder->status =7;
//                $publicOrder->cancellation='provider';
//                $publicOrder->update();
                $fees = Fees::first();
                $this->userBalance($order_user, false, $public->total_amount, $fees->service_cancellation);
                $this->newTransaction($order_user->id, ($public->total_amount - $fees->service_cancellation), $public->id, 'public', 'deposit', "ايداع رصيد تعميد عام رقم $public->id ");
                $this->walletMuamlah($fees->service_cancellation, $public->price, $public->id, 'public', 'deposit', "رسوم الغاء طلب تعميد عام رقم $public->id");
                PublicOrder::where('master_order', $public->master_order)->update(['status' => 7, 'cancellation' => 'provider', 'verify' => 'yes']);
                $data = [
                    'message' => "تم  الغاء  طلب التعميد العام رقم $public->id من طرف مقدم الخدمة ",
                    'link' => route('publicOrders.showDetails', $public->id),
                ];
                Notification::send($notify_user, new StatusUpdatePublicOrderNotify($public, $data));
                DB::commit();

                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }
            elseif ($status == 7) {

                DB::beginTransaction();
                $fees = Fees::first();
                $this->userBalance($order_user, false, $public->total_amount, $fees->service_cancellation);
                $this->newTransaction($order_user->id, ($public->total_amount - $fees->service_cancellation), $public->id, 'public', 'deposit', "ايداع رصيد تعميد عام رقم $public->id ");
                $this->walletMuamlah($fees->service_cancellation, $public->price, $publicOrder->id, 'public', 'deposit', "رسوم الغاء طلب تعميد عام رقم $public->id");
                $data = [
                    'message' => "تم تاكيد الغاء  طلب التعميد العام رقم $public->id من طرف مقدم الخدمة ",
                    'link' => route('publicOrders.showDetails', $public->id),
                ];
                Notification::send($notify_user, new StatusUpdatePublicOrderNotify($public, $data));
                PublicOrder::where('master_order', $public->master_order)->update(['status' => 7, 'cancellation' => 'provider', 'verify' => 'yes']);
                DB::commit();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }
        }catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

}
