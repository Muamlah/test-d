<?php

namespace App\Http\Requests\Website\Register;

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
            'name' => 'required',
            'phone' => 'required|regex:/^(05)([0-9]{8})$/|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/',
            'accept_terms' => 'required|in:1',
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
