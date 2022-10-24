<?php

namespace App\Http\Requests\Website\PrivateOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Auth;

/**
 * Class Store
 * @package App\Http\Requests\Website\PrivateOrder
 */
class Update extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
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

        return Gate::forUser(Auth::user())->allows('owner', $this->privateOrder);
    }
}
