<?php

namespace App\Http\Resources\PublicOrder;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PublicOrder as CRD;

/** @mixin \App\Models\PublicOrder */
class PublicOrder extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->deadline){
            $deadline=Carbon::parse($this->deadline) ->format('Y-m-d H:i');
        }else{
            $deadline = '-';
        }
        if($this->price){
            $price=$this->price;
        }else{
            $price = '-';
        }
        if($this->provider_id){
            $provider=$this->provider->phone;
        }else{
            $provider ='-';
        }
        if($this->user_id){
            $user_name=$this->user->name;
        }else{
            $user_name ='-';
        }

        $check = false;
        if($this->parent_order == 0)
        {
            $order = CRD::where('parent_order',$this->id)->first();
            if(empty($order))
            {
                $check = false;
            }
            else
            {
                $check = true;
            }
        }
        else
        {
            $check = true;
        }
        // dd($this->user);
        return [
            'id' => $this->id,
            'price' => $price,
            'title' => $this->title,
            'pay_status' => $this->pay_status,
            'payment_mathod'=> !empty($this->paymentMathod) ? $this->paymentMathod->payment_gateway_type : '',
            'status' => $this->status,
            'deadline' =>  $deadline,
            'created_at' => @$this->created_at->format('Y-m-d H:i'),
            'user_phone' => $this->user->phone,
            'service_provider_phone' => $provider,
            'user_name' => $user_name,
            'user_id' => $this->user_id,
            'check' => $check,
        ];
    }
}
