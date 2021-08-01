<?php

namespace App\Http\Requests\Admin\employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateEmployeeRequest extends FormRequest
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
            'name' => "required",
            'salary' => "required|numeric",
            'start_date' => "required",
            'job_id' => "required|exists:jobs,id",
        ];
    }
}
