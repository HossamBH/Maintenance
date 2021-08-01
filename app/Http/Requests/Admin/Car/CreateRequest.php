<?php

namespace App\Http\Requests\Admin\Car;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'license_number' => "required",
            'color' => "required",
            'motor_no' => "required|numeric",
            'year' => "required|numeric",
            'kms' => "required|numeric",
            'type' => "required",
            'customer_id' => "required|exists:customers,id",
        ];
    }
}
