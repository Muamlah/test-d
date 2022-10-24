<?php

namespace App\Http\Resources\PublicOrder;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\PublicOrder */
class BalanceRequest extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [
            'id'                    => $this->id,
            'user_id'               => $this->user_id,
            'user_phone'            => !empty($this->user) ? $this->user->phone : '',
            'user_name'             => !empty($this->user) ? $this->user->name : '',
            'account_number'        => !empty($this->credit) ? $this->credit->account_number : '',
            'available_balance'     => !empty($this->user) ? $this->user->available_balance : '',
            'amount'                => $this->amount,
            'created_at'            => $this->created_at->format('Y-m-d'),
            'payment_status'        => $this->payment_status,
            'ref'                   => $this->ref,
        ];
    }
}
