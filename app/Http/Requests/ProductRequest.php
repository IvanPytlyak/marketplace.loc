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
        $rules = [
            'code' => 'required|min:3|max:255',
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:1',
            'description' => 'required|min:5',
            'price' => 'required',
        ];


        if ($this->route()->named('products.store') || $this->route()->named('products.update')) {
            $rules['code'] .= '|unique:products,code';
            return  $rules;
        }
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения', // :attribute  указывает на конкретное поле
            'min' => 'Поле :attribute должно иметь минимум :min символа',
            'max' => 'Поле :attribute должно иметь минимум :max символов',
            'code.min' => 'Поле "Код" должно содержать минимум :min символа',
            'name.min' => 'Поле "Имя" должно содержать минимум :min символа',
            'description.min' => 'Поле "Описание" должно содержать  минимум :min символов',
            'price.required' => 'Заполни',
        ];
    }
}
