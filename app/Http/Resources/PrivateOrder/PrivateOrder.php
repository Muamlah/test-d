<?php

namespace App\Http\Resources\PrivateOrder;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PrivateOrder as CRD;

/** @mixin \App\Models\PrivateOrder */
class PrivateOrder extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
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
        return [
            'id' => $this->id,
            'price' => $this->price,
            'payment_mathod'=> !empty($this->paymentMathod) ? $this->paymentMathod->payment_gateway_type : '',
            'pay_status' => $this->pay_status,
            'count_mass' => $this->pay_status,
            'status' => $this->status,
            'status_id' => $this->status_id,
            'deadline' =>  Carbon::parse($this->deadline) ->format('Y-m-d H:i'),
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'user_phone' => $this->user_phone,
            'service_provider_phone' => $this->service_provider_phone,
            'user_name' => $user_name,
            'user_id' => $this->user_id,
            'check' => $check,
        ];
    }
}
