<?php

namespace App\Http\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Eservices
 * @package App\Http\Resources\EServices
 */
class UserLog extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'user_id'           => $this->user_id,
            'user_name'         => $this->user_name,
            'user_email'        => $this->user_email,
            'price'             => $this->price,
            'action'            => $this->action,
            'date'              => Carbon::parse($this->date)->format('Y-m-d H:i'),
            'description'       => $this->description,
        ];
    }
}
