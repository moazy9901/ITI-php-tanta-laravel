<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:255',
            'description' => 'nullable|min:5',
            'price' => 'required|numeric|min:0',
            'image' => 'image|nullable|mimes:jpg,png,jpeg|max:2048',
            'stock_quantity' => 'nullable|numeric|min:0',
            'is_active'      => 'nullable|boolean',
            'category_id' => 'nullable'
        ];
    }
}
