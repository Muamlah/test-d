<?php

namespace App\Http\Resources\PrivateOrder;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'                => $this->id,
            'created_at'        => $this->created_at->format('Y-m-d H:i'),
            'phone'             => !empty($this->user) ? $this->user->phone : '',
            'description'       => $this->description,
            'amount'            => $this->amount,
            'type'              => $this->type,
        ];
    }
}
