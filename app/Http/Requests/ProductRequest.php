<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'code' => 'required|min:3|max:255|unique:products,code',
            'name' => 'required|min:3|max:255',
            'description' =>  'required|min:3|max:2255',
            'price' => 'required',
        ];
        if ($this->route()->named('products.update')) { // products.update / если был переход по ресурсному роуту (true/false)
            $rules['code'] .= ',' . $this->route()->parameter('product')->id;
        }

        return  $rules;
    }
    public function messages()
    {
        return [
            'required' => 'Поле является обязательным для заполнения',
            'min' => 'Поле :attribute должно иметь не менее :min символа',
            'max' => 'Поле :attribute должно иметь :max символов',
            'code.min' => 'Поле код должно иметь не менее :min символа',
            'name.min' => 'Поле название должно иметь не менее :min символа',
            'description.min' => 'Поле описание должно иметь не менее :min символа',
            'code.max' => 'Поле код должно иметь :max символов',
            'name.max' => 'Поле название должно иметь :max символов',
            'description.max' => 'Поле описание должно иметь :max символов',
            'unique' => 'Этот код уже занят'
        ];
    }
}
