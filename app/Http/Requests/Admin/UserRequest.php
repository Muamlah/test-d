<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'POST')
        {
            return [
                'name'  => 'string|max:191',
                'email'       => 'nullable|email|unique:users,email,'.$this->route('id'),
                'phone'      => 'required|string|max:191',
//                'password'     => 'required',
                'level'     => 'required',
            ];
        }
        else if($this->method() == 'PUT')
        {
            return [
                'name'  => 'string|max:191',
                'email'       => 'nullable|unique:users,email,'.$this->route('id'),
                'phone'      => 'required|string|max:191',
//                'password'     => 'required',
                'level'     => 'required',
            ];
        }

        return [
            //
        ];
    }
}
