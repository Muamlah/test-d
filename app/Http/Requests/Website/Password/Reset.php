<?php

namespace App\Http\Requests\Website\Password;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Store
 * @package App\Http\Requests\Website\PrivateOrder
 */
class Reset extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'phone' => 'required|exists:users,phone|regex:/^(05)([0-9]{8})$/',
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
