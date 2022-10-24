<?php

namespace App\Http\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Eservices
 * @package App\Http\Resources\EServices
 */
class User extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'status' => $this->status,
            'phone' => $this->phone,
            'active' => $this->active,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'total_balance' => $this->total_balance,
            'available_balance' => $this->available_balance,
            'pinding_balance' => $this->pinding_balance,
            'number_of_reference_orders' => $this->number_of_reference_orders,
            'owner_amount_of_reference_orders' => $this->owner_amount_of_reference_orders,
            'user_amount_of_reference_orders' => $this->user_amount_of_reference_orders,
        ];
    }
}
