<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\{eservices_orders, PrivateOrder, Settings, User, Fees, PublicOrder};
use App\Traits\CommonTrait;

class EservicesOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, CommonTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $setting = Settings::first();

        if($setting->eservice_time == '1' || $setting->eservice_time == '7' || $setting->eservice_time == '30'){
            $eservices_orders = eservices_orders::where(function($q){
                $q->where('status',1)->orWhere('status',2);
            })->where('pay_status','complete_convert')->get();
            foreach($eservices_orders as $eservice)
            {
                $time = $eservice->created_at->addDays($setting->eservice_time);
                $now  = \Carbon\Carbon::now();
                if($now->greaterThan($time))
                {
                    $eservice->verify           = true;
                    $fees                       = Fees::first();
                    $user                       = User::find($eservice->user_id);
                    $this->userBalance($user,false,$eservice->total_amount,$fees->service_cancellation);
                    $this->walletMuamlah($fees->service_cancellation,$eservice->price, $eservice->id,'electronic','deposit','رسوم الغاء خدمة اكترونية');

                    $eservice->status = 7;
                    $eservice->save();
                }
            }

            $public_order = PublicOrder::where(function($q){
                $q->where('status',1)->orWhere('status',2);
            })->get();
            foreach($public_order as $public)
            {
                $time = $public->created_at->addDays($setting->public_order_time);
                $now  = \Carbon\Carbon::now();
                if($now->greaterThan($time))
                {
                    $public->status = 7;
                    $public->save();
                }
                
            }
        }
        
        return 'success';
        
    }
}
