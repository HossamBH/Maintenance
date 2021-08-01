<?php

namespace App\Http\Requests\Admin\Expense;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
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
            'type_id' => "required|exists:expense_types,id",
            'total_amount' => "required",
            'payment_type' => "required",

        ];
    }
}
