<?php

namespace App\Http\Requests\Admin\Messages;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Reply
 * @package App\Http\Requests\Website\Messages
 */
class Reply extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'reply'=>'required|string',
            
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
