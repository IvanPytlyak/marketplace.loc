@extends('layouts.app')

@section('title', 'Категория ' . $category->name)

@section('content')
{{-- <div class="row justify-content-center"> --}}
    <div class="col-md-12">
        <h1 id="h1_fix">{{$category->name}}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $category->code }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $category->description }}</td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td><img id="imagefix" src="{{Storage::url($category->image)}}"
                     ></td>
            </tr>
            <tr>
                <td>Кол-во товаров</td>
                <td>{{ $category->products->count() }}</td>
            </tr>
            </tbody>
        </table>
    </div>
{{-- </div> --}}
@endsection