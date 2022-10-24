<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\Website\PrivateOrder\Store;
use App\Http\Requests\Website\PublicOrderRequest;
use App\Models\Settings;
use Illuminate\Http\Request;

use App\Models\ForbiddenWord;
use App\Models\PublicOrder;
use App\Models\PublicOrderOffer;
use App\Notifications\PublicOrderOfferNotify;
use App\Models\Transaction;
use App\Models\WalletMuamlah;
use App\Models\User;
use App\Models\Invoices;
use App\Models\eservices_orders;
use App\Notifications\PrivateOrderNotify;
use App\Traits\FeesTrait;
use App\Traits\GrupoTrait;
use App\Traits\PaymentGatewayTrait;
use App\Traits\SMSTrait;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Notification;
use Throwable;
use App\Notifications\PublicOrderNotify;
use App\Notifications\SendEmailToAdmins;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SendCustomEmailsToAdmins;
use App\Traits\CommonTrait;
use App\Traits\UserLogTreat;
use App\Models\Status;

/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class oldOrderController extends Controller
{

    use SMSTrait;
    use FeesTrait;
    use GrupoTrait;
    use PaymentGatewayTrait;
    use CommonTrait;
    use UserLogTreat;

    /**
     * @return Application|Factory|View
     */

    public function index()
    {
        $this->data['my_orders'] = [];
        if(auth()->check()){
            $user_id=auth()->user()->id;
            if(auth()->user()->level == "provider"){
                $this->data['my_orders'] = PublicOrder::whereIn('status', [2])->orderBy('created_at','desc')->paginate(10);
                $this->data['orders'] = PublicOrder::whereDoesntHave('followingOrders')->whereIn('status', [2])->orderBy('created_at','desc')->where('parent_order', 0)->paginate(10);
            }else{
                $this->data['my_orders'] = PublicOrder::whereIn('status', [2])
                ->where(function($q){
                    if(auth()->check()){
                        $q->where([ 'user_id' => auth()->id()]);
                    }
                    return $q;
                })
                ->orderBy('created_at','desc')->paginate(10);
                $this->data['orders'] = PublicOrder::whereIn('status', [2])->orderBy('created_at','desc')->where('parent_order', 0)->whereDoesntHave('followingOrders')->paginate(10);
            }
            $this->data['eservices_orders'] = eservices_orders::whereIn('status', [1, 2])
            // ->where('pay_status','complete_convert')
            ->with('eservices')
            ->whereHas('eservices')
            ->where(function($q){
                return $q->whereNull('provider_id')->orWhere('provider_id', '0');
            }) /* ->where('user_id','<>',Auth::id()) */->paginate(10);
        }else{
            $this->data['orders'] = PublicOrder::whereIn('status', [2])->orderBy('created_at','desc')->where('parent_order', 0)->paginate(10);
            $this->data['eservices_orders'] = eservices_orders::whereIn('status', [1, 2])->where('pay_status', 'complete_convert')->where(function($q){
                return $q->whereNull('provider_id')->orWhere('provider_id', '0');
            })->orderBy('created_at','desc')->paginate(10);
        }

        $this->data['order_status'] = Status::get();
        return view('website.orders.index', $this->data);

    }
    public function userSeeMore()
    {
//        $user_id=auth()->user()->id;

        $my_orders = PublicOrder::orderBy('updated_at','desc')->whereIn('status', [1,2])
        ->where(function($q){
            if(auth()->check()){
                $q->where(['status' => '1', 'user_id' => auth()->id()]);
            }
            return $q;
        })->paginate(10);
        $view = view('website.orders.ajax-view.ordersUser', compact('my_orders'))->render();
        return response()->json(['html' => $view]);
    }
    public function providerSeeMore()
    {


        if(auth()->check()){
            $orders = PublicOrder::whereIn('status', [2])->where('parent_order', 0)->whereDoesntHave('followingOrders')
            ->orderBy('updated_at','desc')
            ->paginate(10);
            $view = view('website.orders.ajax-view.ordersProvider', compact('orders'))->render();
        }else{
            $orders = PublicOrder::whereIn('status', [2])->orderBy('updated_at','desc')
            ->paginate(10);
            $view = view('website.orders.ajax-view.ordersPublic', compact('orders'))->render();

        }
        return response()->json(['html' => $view]);
    }

    public function eservicesSeeMore()
    {


        if(auth()->check()){
            $this->data['eservices_orders'] = eservices_orders::whereIn('status', [2])->where('pay_status','complete_convert')/* ->where('user_id','<>',Auth::id()) */->paginate(10);
            $view = view('website.orders.ajax-view.eservicesOrders', $this->data)->render();
        }else{
            $this->data['eservices_orders'] = eservices_orders::whereIn('status', [2])->orderBy('created_at','desc')->paginate(10);
            $view = view('website.orders.ajax-view.eservicesOrdersPublic', $this->data)->render();

        }
        return response()->json(['html' => $view]);
    }



    /**
     * @param PublicOrderRequest $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     * @throws GuzzleException
     * @throws Throwable
     */
    public function sendEmail($message1,$message2,$email){

        $info = [
            'message1'         => $message1,
            'message2'         => $message2,
        ];

        Mail::to($email)->send(new SendCustomEmailsToAdmins($info));
    }
    public function store(PublicOrderRequest $request)
    {
        $chack_balance = $this->checkUserBalance(Auth::user());
        if(!$chack_balance)
        {
            return back()->with(['error' => 'عذراً لايمكنك انشاء طلب تعميد عام لأنه يوجد خطأ في رصيدك يرجى مراجعة المشرفين']);
        }

        try {
            $settings = Settings::query()->first();
            $public_count=PublicOrder::where('user_id',Auth::id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            if($public_count >= $settings->public_order_limit){
                abort(401);
            }
            $user = auth()->user();
            $order = PublicOrder::create($request->all() + [
                    'user_id' => Auth::id(),
                    'status' => 1
                ]);
            $order->master_order=$order->id;
            if(request()->has('agent') && request()->agent == '1' && !empty($user->agent_id))
            {
                $order->agent_id = $user->agent_id;
            }
            $order->update();

            $admins             = Admin::where('user_type','order_management')->get();
            $message01          = 'طلب تعميد عام';
            $message02          = 'طلب تعميد عام من المستخدم  '  . auth()->user()->name . ' رقم# '. $order->id;
            foreach($admins as $admin){
                $this->sendEmail($message01,$message02,$admin->email);
            }

            $message1           = 'اضافة طلب تعميد عام';
            $message2           = ' اضافة طلب تعميد عام رقم ' . '#' . $order->id;

            $this->AddUserLog($user,$message1,$message2,$order->price);

            return redirect()->route('publicOrders.offers.show',$order->id)->with('success', 'طلبك قيد المراجعة ، عند التفعيل يمكنك اختيار عرض من مقدمي الخدمات');

        } catch (Throwable $throwable) {
            throw $throwable;
        }

    }


    public  function searchWord(Request $request)
    {
        $keyword=$request->keyword;
        $search_explode=explode(" ",$keyword);
        $condition_arr=array();
        foreach($search_explode as $value){
            $condition_arr[]= ForbiddenWord::query()->Where('name', $value)->first();
        }

        $finder = ForbiddenWord::query()
            ->Where('name', $keyword)
            ->first();
        return response()->json(['success' => $condition_arr]);

    }


}
