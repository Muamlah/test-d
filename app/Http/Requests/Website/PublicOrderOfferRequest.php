<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Store
 * @package App\Http\Requests\Website\PublicOrderOfferRequest
 */
class PublicOrderOfferRequest extends FormRequest
{
    /**
     * @return string[]
     */

    public function rules() : array
    {
        if($this->method() == 'POST') {
            return [
                'date'=>'required',
                'price'=>'required',
            ];
        } else if($this->method() == 'PUT') {
            return [
                'price'=>'required',
            ];
        }

        return [];
    }


    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
