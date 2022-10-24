<?php

namespace App\Http\Controllers\Website;

use App\Models\Admin;
use App\Models\BalanceRequest;
use App\Models\BankAccount;
use App\Models\CreditCard;
use App\Models\Invoices;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Build\BuildDep;
use App\Models\ElectronicServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\PublicOrder;
use App\Models\PrivateOrder;
use App\Models\eservices_orders;
use App\Models\Coupon;
use App\Models\CouponInstance;
use \Carbon\Carbon;
use Throwable;
use App\Traits\CommonTrait;
use App\Traits\FeesTrait;
use App\Traits\UserLogTreat;
use App\Notifications\SendCustomEmailsToAdmins;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

/**
 * Class SettingsController
 * @package App\Http\Controllers\Website
 */
class WalletController extends Controller
{
    use CommonTrait, FeesTrait,UserLogTreat;

    public function index(Request $request): View
    {
        $user = auth()->user();
        if ($user) {
            // $items = Transaction::where('user_id', $user->id) ->orderby('updated_at','desc')->paginate(10);
            // $invoices=Invoices::where('user_id', $user->id)->paginate(10);
            $items = Transaction::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->paginate(10);
            $invoices = collect([]);
            $public_orders = PublicOrder::whereHas('offers')->with(['offers', 'provider', 'user'])->where(function($q) use ($user){
                $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
            })->where('status', 5)->orderBy('updated_at', 'DESC')->paginate(5);
            foreach ($public_orders as $order) {
                if(is_null($order->invoice_code) || $order->invoice_code == "" || $order->invoice_code == 0){
                    $order->invoice_code = $this->generateRandomString();
                    $order->save();
                }
                $item = new \stdClass;
                $item->id = $order->id;
                $item->order_id = $order->id;
                $item->type = 'public';
                $item->created_at = $order->updated_at;
                $item->order = $order;
                $invoices->push($item);
            }

            $private_orders = PrivateOrder::with(['provider', 'user'])->whereIn('status_id', ['5','10'])->where(function($q) use ($user){
                $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
            })->orderBy('updated_at', 'DESC')->paginate(5);

            foreach($private_orders as $order){
                if(is_null($order->invoice_code) || $order->invoice_code == "" || $order->invoice_code == 0){
                    $order->invoice_code = $this->generateRandomString();
                    $order->save();
                }
                $item = new \stdClass;
                $item->id = $order->id;
                $item->order_id = $order->id;
                $item->type = 'private';
                $item->created_at = $order->updated_at;
                $item->order = $order;
                $invoices->push($item);
            }
            $eservices_orders = eservices_orders::with(['provider', 'user'])->where(function($q) use ($user){
                $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
            })->where('provider_id', '!=', 0)->where('pay_status', 'complete_convert')->orderBy('updated_at', 'DESC')->paginate(5);
            foreach($eservices_orders as $order){

                if(is_null($order->invoice_code) || $order->invoice_code == "" || $order->invoice_code == 0){
                    $order->invoice_code = $this->generateRandomString();
                    $order->save();
                }
                $item = new \stdClass;
                $item->id = $order->id;
                $item->order_id = $order->id;
                $item->type = 'eservice';
                $item->created_at = $order->updated_at;
                $item->order = $order;
                $invoices->push($item);
            }

            $invoices = $invoices->sortByDesc('created_at');
            $sumDeposit=Transaction::where('user_id', $user->id)->where('type','deposit')->sum('amount');
            $sumWithdrawal=Transaction::where('user_id', $user->id)->where('type','withdrawal')->sum('amount');

            // chart
            $dateTransactions=Transaction::where('user_id', $user->id)->pluck('created_at');
            $amountDeposit=Transaction::where('user_id', $user->id)->where('type','deposit')->pluck('amount');
            $amountWithdrawal=Transaction::where('user_id', $user->id)->where('type','withdrawal')->pluck('amount');


            $collection = new Collection($dateTransactions);
            $dates = $collection->map(function ($item) {
                return $item->format('Y-m-d');
            });


            $balance_request    = BalanceRequest::where('user_id',auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);

            return view('website.wallet.index',[
                'items' => $items ,
                'user' => $user ,
                'invoices' => $invoices ,
                'sumDeposit' => $sumDeposit ,
                'sumWithdrawal' => $sumWithdrawal ,

                'amountDeposit' => $amountDeposit ,
                'amountWithdrawal' => $amountWithdrawal ,
                'dateTransactions' => $dateTransactions ,
                'dates' => $dates->toArray() ,
                'balance_request' => $balance_request ,
            ]);
        }

    }

    public function seeMoreTransactions()
    {
        $user = auth()->user();

        $items = Transaction::where('user_id', $user->id)
            ->orderby('updated_at','desc')
            ->paginate(10);
        $view = view('website.wallet.ajax-view.transactions', compact('items'))->render();
        return response()->json(['html' => $view]);
    }

    public function seeMoreBalanceRequest()
    {
        $user = auth()->user();

        $balance_request = BalanceRequest::where('user_id', auth()->user()->id)
            ->orderby('updated_at','desc')
            ->paginate(10);
        $view = view('website.wallet.ajax-view.balance_request', compact('balance_request'))->render();
        return response()->json(['html' => $view]);
    }

    public function seeMoreBills()
    {
        $user = auth()->user();
        // $invoices=Invoices::where('user_id', $user->id)
        //     ->orderby('updated_at','desc')
        //     ->paginate(10);
        $invoices= collect([]);
        $public_orders = PublicOrder::whereHas('offers')->with(['offers', 'provider', 'user'])->where('status', 5)->orderBy('updated_at', 'DESC')->paginate(5);
        foreach($public_orders as $order){
            if(is_null($order->invoice_code) || $order->invoice_code == "" || $order->invoice_code == 0){
                $order->invoice_code = $this->generateRandomString();
                $order->save();
            }
            $item = new \stdClass;
            $item->id = $order->id;
            $item->order_id = $order->id;
            $item->type = 'public';
            $item->created_at = $order->updated_at;
            $item->order = $order;
            $invoices->push($item);
        }

        $private_orders = PrivateOrder::with(['provider', 'user'])->where('pay_status', 'complete_convert')->orderBy('updated_at', 'DESC')->paginate(5);
        foreach($private_orders as $order){
            if(is_null($order->invoice_code) || $order->invoice_code == "" || $order->invoice_code == 0){
                $order->invoice_code = $this->generateRandomString();
                $order->save();
            }
            $item = new \stdClass;
            $item->id = $order->id;
            $item->order_id = $order->id;
            $item->type = 'private';
            $item->created_at = $order->updated_at;
            $item->order = $order;
            $invoices->push($item);
        }
        $eservices_orders = eservices_orders::with(['provider', 'user'])->where('provider_id', '!=', 0)->where('pay_status', 'complete_convert')->orderBy('updated_at', 'DESC')->paginate(5);
            foreach($eservices_orders as $order){
                if(is_null($order->invoice_code) || $order->invoice_code == "" || $order->invoice_code == 0){
                    $order->invoice_code = $this->generateRandomString();
                    $order->save();
                }
                $item = new \stdClass;
                $item->id = $order->id;
                $item->order_id = $order->id;
                $item->type = 'eservice';
                $item->created_at = $order->updated_at;
                $item->order = $order;
                $invoices->push($item);
            }
        $view = view('website.wallet.ajax-view.bills', compact('invoices'))->render();
        return response()->json(['html' => $view]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function withdrawalBalance(Request $request): RedirectResponse
    {

        if(auth()->user()->balance_withdrawal == 'no')
        {
            return back()->with(['error' => 'عذراً لايمكنك سحب رصيد لأنه تم ايقاف سحب رصيدك من المشرفين']);
        }

        $chack_balance = $this->checkUserBalance(auth()->user());
        if(!$chack_balance)
        {
            return back()->with(['error' => 'عذراً لايمكنك سحب رصيد لأنه يوجد خطأ في رصيدك يرجى مراجعة المشرفين']);
        }
        if(!$this->checkUserBalancewithdrawal(auth()->user()))
        {
            return back()->with(['error' => 'عذراً لايمكنك سحب رصيد لأنه يوجد لديك طلبات إبلاغ يرجى مراجعة المشرفين']);
        }

        try {

            $amount = $request->amount;
            $user = auth()->user();

            if ($amount > $user->available_balance) {
                return redirect()->back()->with('error', 'المبلغ المطلوب اكبر من الرصيد المتاح');
            }
            if ($amount <= 0) {
                return redirect()->back()->with('error', 'لا يمكن ان اليكون المبلغ اصغر من الصفر');
            }
            $account = CreditCard::where('user_id', $user->id)->first();
            if (!$account) {
                return redirect()->back()->with('error', 'الرجاء ادخال بيانات حسابك البنكي لاتمام هذه العملية');
            }
            $time = Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s');
            $last_request = BalanceRequest::where('user_id', $user->id)->where('created_at', '>=', $time)->first();
            if(!is_null($last_request)){
                return redirect()->back()->with('error', 'لا يمكنك إجراء أكثر من عملية في الدقيقة الواحدة');
            }

            $message1       = 'سحب رصيد';
            $message2       = 'طلب سحب رصيد من المستخدم بقيمة ' . $request->amount;
            $this->AddUserLog($user,$message1,$message2,$request->amount);

            DB::beginTransaction();
            $user->available_balance = $user->available_balance - $amount;
            $user->total_balance = $user->total_balance - $amount;
            $user->update();
            $newRequest = new BalanceRequest();
            $newRequest->user_id = $user->id;
            $newRequest->amount = $amount;
            $newRequest->save();

            $admins             = Admin::where('user_type','financial')->get();
            foreach($admins as $admin){
                $this->sendEmail($message01,$message02,$admin->email);
            }

            DB::commit();
            return redirect()->back()->with('success', 'تم ارسال طلبك بنجاح');
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }

    }

    public function sendEmail($message1,$message2,$email){

        $info = [
            'message1'         => $message1,
            'message2'         => $message2,
        ];

        Mail::to($email)->send(new SendCustomEmailsToAdmins($info));
    }

    public function print_pdf($id, $type){

        if(!auth()->check()){
            abort(401);
        }
        $user = auth()->user();
        $this->data['order'] = [];

        switch($type){
            case 'eservice':
                $this->data['order'] = eservices_orders::with(['user', 'provider'])->where(function($q) use ($user){
                    $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
                })->findOrFail($id);
                break;
            case 'public':
                $this->data['order'] = PublicOrder::with(['user', 'provider'])->where(function($q) use ($user){
                    $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
                })->findOrFail($id);
                break;
            case 'private':
                $this->data['order'] = PrivateOrder::with(['user', 'provider'])->where(function($q) use ($user){
                    $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
                })->findOrFail($id);
                break;
        }

        $this->data['share_link'] = route('view_invoice' ,['code' => $this->data['order']->invoice_code, 'type' => $type]);

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->showImageErrors = false;
        $view = \View::make('website.pdf.invoice')->with(['order' => $this->data['order'], 'share_link' => $this->data['share_link']]);
        $html = $view->render();

        $mpdf->useSubstitutions = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML($html);
        return $mpdf->Output($id . '-invoice.pdf', 'D');

    }

    public function view_invoice($code, $type){

        $user = auth()->user();
        $this->data['order'] = [];

        switch($type){
            case 'eservice':
                $this->data['order'] = eservices_orders::with(['user', 'provider'])->where('invoice_code', $code)->firstOrFail();
                break;
            case 'public':
                $this->data['order'] = PublicOrder::with(['user', 'provider'])->where('invoice_code', $code)->firstOrFail();
                break;
            case 'private':
                $this->data['order'] = PrivateOrder::with(['user', 'provider'])->where('invoice_code', $code)->firstOrFail();
                break;
        }
        $this->data['share_link'] = route('view_invoice' ,['code' => $this->data['order']->invoice_code, 'type' => $type]);
        $view = \View::make('website.pdf.invoice')->with(['order' => $this->data['order'], 'share_link' => $this->data['share_link']]);
        $html = $view->render();
        return $html;

    }
    public function use_gift(Request $request){
        $request->validate([
            'code'  => 'required|string',
        ]);
        $user = auth()->user();

        $gift =  Coupon::where('type', 'gift')->where('code',$request->code)->first();
        if(is_null($gift)){
            return back()->with('gift_error', 'البطاقة غير صالحة');
        }
        $now = Carbon::now()->format('Y-m-d H-i-s');
        if($gift->gift > $now){
            return back()->with('gift_error', 'انتهت صلاحية البطاقة');
        }
        if($gift->Instances()->count() >= $gift->instances_count){
            return back()->with('gift_error', 'البطاقة لم تعد صالحة');
        }
        if($gift->Instances()->where('user_id', $user->id)->where('code', $request->code)->count() >= $gift->number_of_use){
            return back()->with('gift_error', 'تجاوزت العدد المسموح للاستخدام');
        }

        DB::beginTransaction();
        $instance = new CouponInstance;
        $instance->user_id = $user->id;
        $instance->coupon_id = $gift->id;
        $instance->code = $gift->code;
        $instance->discount = $gift->discount;
        $instance->amount = $gift->discount;
        $instance->discount_type = $gift->discount_type;
        $instance->number_of_use = $gift->number_of_use;
        $instance->max_discount = $gift->max_discount;
        $instance->type = $gift->type;
        $instance->save();
        $user->available_balance = $user->available_balance + $gift->discount;
        $user->total_balance = $user->total_balance + $gift->discount;
        $user->update();
        $this->newTransaction($user->id, $user->available_balance, $instance->id, 'gift', 'deposit', "تم شحن الرصيد باستخدام بطاقة شحن");

        $message1       = 'شحن رصيد';
        $message2       = 'تم شحن الرصيد باستخدام بطاقة شحن بقيمة  ' . $instance->amount;
        $this->AddUserLog($user,$message1,$message2,$instance->amount);

        DB::commit();
        return redirect()->back()->with('gift_success', 'تم شحن الرصيد بنجاح');
    }

    public function generateRandomString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
