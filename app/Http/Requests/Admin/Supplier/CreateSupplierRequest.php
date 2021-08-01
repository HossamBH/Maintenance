<?php

namespace App\Http\Requests\Admin\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
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
            'company_name' => "required",
            'company_tel_no' => "required|size:10|regex:/0[1-9]{9}/",
            'email' => ['required', 'email'],
            'contact_person_mobile' => "required|size:11|regex:/(01)[0-9]{9}/",
            'contact_person_name' => "required",
            'address' => "required",
            'contact_person_email' => ['required', 'email'],


        ];
    }
}
