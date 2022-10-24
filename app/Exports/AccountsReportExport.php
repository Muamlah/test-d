<?php

namespace App\Exports;


use App\Models\eservices_orders;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
//use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

class AccountsReportExport implements FromView, ShouldAutoSize ,WithEvents
{

    protected $to = null;
    protected $type = null;
    protected $start = null;


    public function __construct($type, $start, $to, $status)
    {
        $this->type = $type;
        $this->start = $start;
        $this->to = $to;
        $this->status = $status;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }
    public function view(): View
    {
        $orders = collect([]);

        $public_orders = PublicOrder::whereIn('status', $this->status)->whereNotNull('provider_id')->whereBetween('created_at', [$this->start, $this->to])->orderBy('updated_at', 'DESC')->get();

        $users_id=User::whereIn('phone',['0595121439','0545326570','0564550238','0595108617','0595121439','0591407268'])->pluck('id');

        $feedback = collect([]);
        $public_feedback = PublicOrder::whereBetween('created_at', [$this->start, $this->to])->where('parent_order','!=',0)->where('status',5)->whereIn('user_id',$users_id)->get();

        foreach ($public_feedback as $order) {
           $transaction_deposit= Transaction::where('order_id',$order->master_order)->where('user_id',$order->user_id)->where('order_type','public')->where('type','deposit')->first();
           $transaction_withdrawal= Transaction::where('order_id',$order->id)->where('user_id',$order->user_id)->where('order_type','public')->where('type','withdrawal')->first();
            $item = new \stdClass;
            $item->title = ($order->parent_order != 0) ? "تعميد عام رقم $order->id @ تابع $order->parent_order" : "تعميد عام رقم $order->id";
            $item->name = User::find($order->user_id)->getName();
            $item->user_id = $order->user_id;
            $item->fees = $transaction_deposit->amount -  $transaction_withdrawal->amount;
            $item->type = 'eservices orders';
            $item->created_at = $order->created_at->format('Y-m-d H:i');
            $feedback->push($item);
        }
        $private_feedback = PrivateOrder::whereBetween('created_at', [$this->start, $this->to])->where('parent_order','!=',0)->where('status_id',5)->whereIn('user_id',$users_id)->get();

        foreach ($private_feedback as $order) {
            $transaction_deposit= Transaction::where('order_id',$order->master_order)->where('user_id',$order->user_id)->where('order_type','private')->where('type','deposit')->first();
            $transaction_withdrawal= Transaction::where('order_id',$order->id)->where('user_id',$order->user_id)->where('order_type','private')->where('type','withdrawal')->first();
            $item = new \stdClass;
            $item->title = ($order->parent_order != 0) ? "تعميد خاص رقم $order->id @ تابع $order->parent_order" : "تعميد خاص رقم $order->id";
            $item->name = User::find($order->user_id)->getName();
            $item->user_id = $order->user_id;
            $item->fees = $transaction_deposit->amount -  $transaction_withdrawal->amount;
            $item->type = 'private';
            $item->created_at = $order->created_at->format('Y-m-d H:i');
            $feedback->push($item);
        }
       $data = $feedback->groupBy('user_id');
        $feedback_view["name"][0] ='';
        $feedback_view["total"][0] =0;
        $feedback_view["data"][0] = 0;
       $feedback_view= array();
        foreach ($data as $key=>$feedback_data){
            $feedback_view["name"][$key] = $feedback_data[0]->name;
            $feedback_view["total"][$key] = $feedback->where('user_id', $key)->sum('fees');
            $feedback_view["data"][$key] = $feedback_data;

        }
//        foreach($feedback_view['name'] as $key=>$item){
//            echo $item ;
//
//        }
//
//dd($feedback_view["name"]);
        foreach ($public_orders as $order) {
            if ($order->status == 7 || $order->status == 5) {
                $type = "منصرف";
            } else {
                $type = "وارد";
            };
            $item = new \stdClass;
            $item->title = ($order->parent_order != 0) ? "تعميد عام رقم $order->id @ تابع $order->parent_order" : "تعميد عام رقم $order->id";
            $item->status = $order->statusName();
            $item->status_id = $order->status;
            $item->parent_order = $order->parent_order;
            $item->price = $order->price;
            $item->fees = $order->fees + $order->provider_fees;
            $item->value_added_tax = $order->value_added_tax + $order->provider_value_added_tax;
            $item->feedback_value = 0;
            $item->client_cancellation = $order->client_cancellation;
            $item->type = 'public';
            $item->pay_status = ($order->pay_status == 'complete_convert') ? "تم الدفع" : " لم  يتم  الدفع ";
            $item->pay_type = $type;
            $item->created_at = $order->created_at->format('Y-m-d H:i');
            $orders->push($item);
        }

        $private_orders = PrivateOrder::whereIn('status_id', $this->status)->whereBetween('created_at', [$this->start, $this->to])->get();

        foreach ($private_orders as $order) {
            if ($order->status_id == 7 || $order->status_id == 5) {
                $type = "منصرف";
            } else {
                $type = "وارد";
            };
            $item = new \stdClass;
            $item->title = ($order->parent_order != 0) ? "تعميد خاص رقم $order->id @ تابع $order->parent_order" : "تعميد خاص رقم $order->id";
            $item->status = $order->statusName();
            $item->status_id = $order->status_id;
            $item->parent_order = $order->parent_order;
            $item->price = $order->price;
            $item->fees = $order->provider_fees;
            $item->value_added_tax = $order->provider_value_added_tax;
            $item->feedback_value = 0;
            $item->client_cancellation = $order->client_cancellation;
            $item->type = 'private';
            $item->pay_status = ($order->pay_status == 'complete_convert') ? "تم الدفع" : " لم  يتم  الدفع ";
            $item->pay_type = $type;
            $item->created_at = $order->created_at->format('Y-m-d H:i');
            $orders->push($item);
        }
        $eservices_orders = eservices_orders::whereIn('status', $this->status)->whereNotNull('provider_id')->whereBetween('created_at', [$this->start, $this->to])->orderBy('updated_at', 'DESC')->get();
        foreach ($eservices_orders as $order) {
            if ($order->status == 7 || $order->status == 5) {
                $type = "منصرف";
            } else {
                $type = "وارد";
            };
            $item = new \stdClass;
            $item->title = "خدمة الكترونية رقم $order->id";
            $item->status = $order->statusName();
            $item->status_id = $order->status;
            $item->parent_order = $order->parent_order;
            $item->price = $order->price;
            $item->fees = $order->fees + $order->provider_fees;
            $item->value_added_tax = $order->value_added_tax + $order->provider_value_added_tax;
            $item->feedback_value = 0;
            $item->client_cancellation = $order->client_cancellation;
            $item->type = 'eservice';
            $item->pay_status = ($order->pay_status == 'complete_convert') ? "تم الدفع" : " لم  يتم  الدفع ";
            $item->pay_type = $type;
            $item->created_at = $order->created_at->format('Y-m-d H:i');
            $orders->push($item);
        }

        $orders = $orders->sortByDesc('created_at');
        $countByStatus = $orders->countBy('status_id');

        $countByStatus = $orders->countBy('status_id');
        $status=Status::get();
        $countByStatusBasic = $orders->where('parent_order', 0)->countBy('status_id');
        foreach ($this->status as $id){
            $accounts["name_$id"] = $status->where('id',$id)->pluck('name')[0];

            $accounts["countStatus_$id"] = $countByStatus->get($id);
            $accounts["totalStatus_$id"] = $orders->where('status_id', $id)->sum('price');

            $accounts["countStatusBasic_$id"] = $countByStatusBasic->get($id);

            $accounts["totalStatusBasic_$id"] = $orders->where('parent_order', 0)->where('status_id', $id)->sum('price');
        }

//        $accounts['totalCanceledBasic'] = $orders->where('parent_order', 0)->where('status_id', 7)->sum('price');

//        $accounts['totalPendingExecutionBasic'] = $orders->where('parent_order', 0)->where('status_id', 2)->sum('price') + $orders->where('parent_order', 0)->where('status_id', 3)->sum('price') + $orders->where('parent_order', 0)->where('status_id', 4)->sum('price') + $orders->where('parent_order', 0)->where('status_id', 5)->sum('price') + $orders->where('parent_order', 0)->where('status_id', 8)->sum('price') + $orders->where('parent_order', 0)->where('status_id', 6)->sum('price');


        $accounts['totalReturnFee'] = $orders->where('status_id', 7)->sum('client_cancellation');

        $accounts['totalDeliveredFee'] = $orders->where('status_id', 5)->sum('fees');
        $accounts['netFeedbackOffice'] = $feedback->sum('fees') * 0.6;
        $accounts['totalFeedback'] = $feedback->sum('fees');

        $accounts['netRevenue'] = $accounts['netFeedbackOffice']+$orders->where('status_id', 7)->sum('client_cancellation') + $orders->where('status_id', 5)->sum('fees');

//        $accounts['totalDelivered'] = $orders->where('status_id', 5)->sum('price');
//        $accounts['totalCanceled'] = $orders->where('status_id', 7)->sum('price');
//        $accounts['pendingExecution'] = $orders->where('status_id',2)->sum('price')+$orders->where('status_id',3)->sum('price')+$orders->where('status_id',4)->sum('price')+$orders->where('status_id',5)->sum('price')+$orders->where('status_id',8)->sum('price')+$orders->where('status_id',6)->sum('price');

        $accounts['totalAlrajhi'] = 0;
        $accounts['totalAlahly'] = 0;
        $accounts['totalCommissionsDelivered'] = $orders->where('status_id', 5)->sum('fees');
        $accounts['totalAddedTax'] = $orders->where('status_id', 5)->sum('value_added_tax');
        $date['start'] = $this->start;
        $date['to'] = $this->to;

//        dd($orders);
        return view('exports.admin.accounts_report', ['feedback_view' => $feedback_view,'orders' => $orders, 'date' => $date, 'accounts' => $accounts,  'thisStatus' => $this->status]);
    }

}
