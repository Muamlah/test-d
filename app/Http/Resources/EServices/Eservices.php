<?php

namespace App\Http\Resources\EServices;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Eservices
 * @package App\Http\Resources\EServices
 */
class Eservices extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                        => $this->id,
            'img'                       => $this->img,
            'sections_name'             => (!empty($this->sections)) ? $this->sections->name : 'deleted',
            'service_name'              => $this->service_name,
            'details'                   => $this->details,
            'price'                     => $this->price,
            'total_amount'              => $this->total_amount,
            'created_at'                => $this->created_at,
            'status'                    => $this->status,
            'pay_status'                => $this->pay_status,

        ];
    }
}
