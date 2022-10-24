<?php

namespace App\Http\Requests\Website\FollowingOrder;

use App\Models\PrivateOrder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Auth;

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
            'id' => 'required|numeric',
            'service_provider_phone' => 'required|numeric|regex:/^(05)([0-9]{8})$/',
            'date'=>'required',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
         $followingOrder = PrivateOrder::where('id',$this->id)->first();
        return Gate::forUser(Auth::user())->allows('createFollowingOrder', $followingOrder);
    }
}
