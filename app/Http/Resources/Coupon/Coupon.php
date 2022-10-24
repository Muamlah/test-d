<?php

namespace App\Http\Resources\Coupon;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


/** @mixin \App\Models\PublicOrder */
class Coupon extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [
            'id' => $this->id,
            'code' => $this->code,
            'type' => $this->type,
            'instances_count' => $this->instances_count,
            'number_of_use' => $this->number_of_use,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'discount' => $this->discount,
            'owner_id' => $this->owner_id,
            'owner_discount' => $this->owner_discount,
            'max_discount' => $this->max_discount,
            'discount_type' => $this->discount_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'owner_name'=> !empty($this->owner) ? $this->owner->name . $this->owner->full_name : '',
        ];
    }
}
