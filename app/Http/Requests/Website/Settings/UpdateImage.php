<?php

namespace App\Http\Requests\Website\Settings;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Store
 * @package App\Http\Requests\Website\PrivateOrder
 */
class UpdateImage extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|max:2024',
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
