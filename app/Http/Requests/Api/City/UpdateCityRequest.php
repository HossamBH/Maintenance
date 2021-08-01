<?php

namespace App\Http\Requests\Api\City;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateCityRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name_en' => "required|regex:/^[A-Za-z0-9_ ?]+$/|unique:cities,name_en," . $request->segment(3),
            'name_ar' => "required|regex:/^[ء-ي ?0-9]+$/u|unique:cities,name_ar," . $request->segment(3),
        ];
    }
}
