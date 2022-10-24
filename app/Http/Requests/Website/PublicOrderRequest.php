<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Store
 * @package App\Http\Requests\Website\PrivateOrder
 */
class PublicOrderRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'id'=>'required',
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
