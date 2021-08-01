<?php

namespace App\Http\Requests\Admin\City;

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
            'name_en' => "required|regex:/^[A-Za-z0-9_\s]+$/|unique:cities,name_en,".$request->segment(2),
            'name_ar' => "required|string|regex:/^[ء-ي ?0-9]+$/u|unique:cities,name_ar,".$request->segment(2),
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Area Name is required',
            'name_ar.unique'=>' Arabic Name is existed',
            'name_en.unique'=>'English Name is existed',
            'name_ar.required'=>'Arabic Name is required',
            'name.regex'=>'English name is not correct ,please write it in english',
            'name_ar.regex'=>'من فضلك ادخل اسم عربى صحيح',
        ];
    }
}
