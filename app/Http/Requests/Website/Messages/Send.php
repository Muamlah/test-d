<?php

namespace App\Http\Requests\Website\Messages;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Send
 * @package App\Http\Requests\Website\Messages
 */
class Send extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'email'=>'required|email',
            'subject'=>'required|string',
            'message'=>'required|string',
            
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
