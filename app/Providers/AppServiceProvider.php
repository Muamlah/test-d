<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Message;
use App\Models\Settings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        view()->composer('*', function ($view)
        {
            $un_seen_messages_count = 0;
            if(auth()->user()){
                $user_id=auth()->user()->id;
                //   // عدد الطلبات العامة اليومية لليوزر
                //   $public_count=PublicOrder::where('user_id',$user_id)->
                //   whereDate('created_at', '=', Carbon::today()->toDateString())->count();
                // عدد الطلبات الخاصة اليومية لليوزر
                //   $private_count=PrivateOrder::where('user_id',$user_id)->
                //   whereDate('created_at', '=', Carbon::today()->toDateString())->count();
                // عدد  قبول الطلبات الالكترونية اليومية لليوزر
                //   $electronic_user_count=eservices_orders::where('user_id',$user_id)->
                //   whereDate('created_at', '=', Carbon::today()->toDateString())->count();

                // عدد الطلبات الالكترونية اليومية لمقدم الخدمة
                //   $electronic_provider_count=eservices_orders::where('provider_id',$user_id)->
                //   whereDate('created_at', '=', Carbon::today()->toDateString())->count();
                // عدد العروض للطلبات العامة اليومية لمقدم الخدمة
                // $order_offer_count=PublicOrderOffer::where('user_id',$user_id)->
                // whereDate('created_at', '=', Carbon::today()->toDateString())->count();

                $un_seen_messages_count = Message::whereHas('parent' , function($q) use ($user_id){
                    return $q->where(function($q) use ($user_id){
                        $q->where('user_id', $user_id)->orWhere('user_id2', $user_id);
                    });
                })->whereNotNull('parent_id')->where('seen', '0')->count();
            }else{
                $public_count=0;
                $private_count=0;
                $electronic_user_count=0;
                $electronic_provider_count=0;
                $order_offer_count=0;
            }
            //...with this variable
            $setting =  \Cache::rememberForever('setting',  function () {
                return Settings::query()->first();
            });
            $admin =  \Cache::rememberForever('admin',  function () {
                return Admin::first();
            });
            $view->with([
                'setting' => $setting,
                'admin' => $admin,
                // 'count_request_balance'=> BalanceRequest::where('status','waiting')->count(),
                // 'count_public_orders'=> PublicOrder::where('status',1)->count(),
                // 'count_private_orders'=> PrivateOrder::where('status_id',1)->count(),
                // 'count_orders'=> PublicOrder::where('status',1)->count() + PrivateOrder::where('status_id',1)->count(),
                // 'public_count'=> $public_count,
                // 'private_count'=> $private_count,
                // 'electronic_user_count'=> $electronic_user_count,
                // 'electronic_provider_count'=> $electronic_provider_count,
                // 'order_offer_count'=> $order_offer_count,
                'un_seen_messages_count' => $un_seen_messages_count

            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
