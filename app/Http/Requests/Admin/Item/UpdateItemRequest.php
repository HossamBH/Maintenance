<?php

namespace App\Http\Requests\Admin\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateItemRequest extends FormRequest
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
            'serial_number' => "required|numeric",
            'description' => "required",
            'price' => "required|numeric",
            'active' => "required",
            'unit' => "required",
            'category_id' => "required|exists:categories,id",
        ];
    }
}
