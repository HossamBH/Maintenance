<?php

namespace App\Http\Requests\Api\Item;

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
            'name' => "required|unique:items,name," . $request->segment(3),
            'serial_number' => "required|numeric",
            'description' => "required",
            'price' => "required|numeric",
            'taxed_price' => "required|numeric",
            'active' => "required|in:0,1",
            'unit' => "required",
            'user_id' => "required|exists:users,id",
            'category_id' => "required|exists:categories,id",
        ];
    }
}
