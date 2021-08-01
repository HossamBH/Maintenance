<?php

namespace App\Http\Requests\Admin\Area;

use Illuminate\Foundation\Http\FormRequest;

class CreateAreaRequest extends FormRequest
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
            'name_en' => "required|unique:cities|regex:/^[A-Za-z0-9_\s]+$/",
            'name_ar' => "required|unique:cities|string|regex:/^[ء-ي ?0-9]+$/u",
            'city_id' => "required|exists:cities,id"
        ];
    }
    public function messages()
    {
        return [
            'name_en.required'=>'Area Name is required',
            'name_en.unique'=>'Name is existed',
            'name_ar.required'=>'Area Name is required',
            'name_ar.unique'=>'Name is existed',
            'name_ar.required'=>'Arabic Name is required',
            'name_en.regex'=>'English name is not correct ,please write it in english',
            'name_ar.regex'=>'من فضلك ادخل اسم عربى صحيح',
        ];
    }
}
