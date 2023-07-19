<?php

namespace App\Http\Requests\Admin\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutUsRequest extends FormRequest
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
            "description" => "",
            "email" => "email",
            "phone_number" => "",
            "address" => "",
            "image"=> "image|mimes:jpeg,png,jpg|max:2048"
        ];
    }
}
