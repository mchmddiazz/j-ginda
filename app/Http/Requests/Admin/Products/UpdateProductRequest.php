<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        return [
            "name" => "",
            "price" => "numeric",
            "priceDisc" => "numeric",
            "quantity_threshold" => "numeric",
            "weight" => "numeric",
            "description" => "max:1000",
            "slideActive" => "boolean",
            "image"=> "image|mimes:jpeg,png,jpg|max:2048"
        ];
    }
}
