<?php

use App\Models\Settings;
use App\Models\Fees;
use Illuminate\Support\Facades\Cache;


/**
 * @return mixed
 */
function settings()
{
    return Settings::find(1);
}

function fess()
{
    return Fees::find(1);
}
function CalculateFees($price)
{
    $fees = Fees::first();

    if ($price >= 3300) {
        $fees['fee'] = $price * ($fees->client_platform_fee / 100); // 0.035
        $fees['offer_fee'] =  $price * ($fees->offer_platform_fee / 100);

    }

    if ($price < 3300 && $price > 1000) {
        $fees['fee'] = $fees->client_less_than_3300;
    }

    if ($price <= 1000) {
        $fees['fee'] = $fees->client_less_than_1000;
    }

    $fees['client_cancellation'] = $fees->client_cancellation;
    $fees['value_added_tax'] = $fees->value_added_tax;
    $fees['tax_amount'] = ($fees->value_added_tax /100) * $fees['fee'] ;
    $fees['payment_gateway_fee'] = $fees->payment_gateway_fee;

    return $fees;

}
function can($permission)
{
    $admin=  auth()->guard('admin')->user();

    if(!$admin->roles->isEmpty()){
        foreach ($admin->roles as $role){
        $admin_permission=$role->permissions->pluck('name')->toArray();
    }
    return in_array($permission, $admin_permission);

    }else{
        return false;
    }

}

