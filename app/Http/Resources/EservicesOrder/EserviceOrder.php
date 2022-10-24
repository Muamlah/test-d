<?php

namespace App\Http\Resources\EservicesOrder;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Eservices
 * @package App\Http\Resources\EServices
 */
class EserviceOrder extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'img' => $this->img,
            'sections_name' => (!empty($this->sections)) ? $this->sections->name : '',
            'service_name' => !empty($this->eservices) ? $this->eservices->service_name : '',
            'payment_mathod'=> !empty($this->paymentMathod) ? $this->paymentMathod->payment_gateway_type : '',
            'details' => $this->details,
            'price' => $this->price,
            'total_amount' => $this->total_amount,
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d H:i:s A'),
            'status' => $this->status,
            'pay_status' => $this->pay_status,
            'user' => $this->user,
            'provider' => $this->provider,

        ];
    }
}
