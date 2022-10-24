<?php

namespace App\Http\Requests\Website\Settings;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Store
 * @package App\Http\Requests\Website\PrivateOrder
 */
class UpdateProfile extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
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
