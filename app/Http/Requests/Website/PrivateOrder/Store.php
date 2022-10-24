<?php

namespace App\Http\Requests\Website\PrivateOrder;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Store
 * @package App\Http\Requests\Website\PrivateOrder
 */
class Store extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'user_phone'=>'required',
            'service_provider_phone'=>'required|regex:/^(05)([0-9]{8})$/',
            'date'=>'required',
            // 'time'=>'required',
            'price'=>'required',
            'details'=>'required'
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
