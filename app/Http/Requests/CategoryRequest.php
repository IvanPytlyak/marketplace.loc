<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // return false; изменен для работы этого контроллера условный вкл/выкл
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() // вставляем условия валидации
    {
        $rules = [
            'code' => 'required|min:3|max:255|unique:categories,code',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
        ];

        if ($this->route()->named('categories.update')) { // проверяем если роут ведет на создание новой группы // named- занаследованный метод / ('categories.store') ресурсный именованный маршрут с методом store из контроллера
            $rules['code'] .=  ',' . $this->route()->parameter('category')->id; // универсальная, под капотом прибавляет к коду категории ее id  что дает возможность сохранять изменения в других полях, в пративном случае будет бить ошибку, что такой код уже используется 14 лекция
        };
        return  $rules;
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
        ];
    }
}
