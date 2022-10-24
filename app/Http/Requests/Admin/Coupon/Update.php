<?php

namespace App\Http\Requests\Admin\Coupon;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Store
 * @package App\Http\Requests\Website\Coupon
 */
class Update extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'type' => 'required',
            'code' => 'required|string',
            'discount' => 'required',
            'discount_type' => 'required_if:type,in:coupon',
            'max_discount' => 'required_if:type,in:coupon',
            'instances_count' => 'required',
            'number_of_use' => 'required',
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
