<?php

namespace App\Http\Requests\Admin\RequestProduction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestProductionRequest extends FormRequest
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
            "type" => "in:cancel,save",
            "request_production_ids" => "array",
            "request_production_ids.*" => "numeric",
            "actual_quantities" => "array",
            "actual_quantities.*" => "numeric|nullable",
        ];
    }
}
