<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|min:3|max:255', // code обязателен для заполнения  |unique:categories,code
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:1',
            'description' => 'required|min:5',
        ];
    }
}
