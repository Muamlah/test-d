<?php

namespace App\Http\Resources\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'order_type' => $this->order_type == 'public'?'تعميد عام':($this->order_type == 'private'?'تعميد خاص':'خدمة الكترونية'),
            'amount' => $this->amount,
            'balance' => $this->balance,
            'type' => $this->type =='deposit'?'ايداع':'سحب' ,
            'description' =>  $this->description,
        ];
    }
}
