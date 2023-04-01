@extends('layouts.app')

@section('title', 'Товар ' . $product->name)

@section('content')
{{-- <div class="row justify-content-center"> --}}
    <div class="col-md-12">
        <h1>{{$product->name}}</h1>
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
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $product->category->name}}</td>
            </tr>
            <tr>
            <tr>
                <td>Описание</td>
                <td>{{ $product->description}}</td>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{{ $product->price }}</td>
            </tr>
                <td>Картинка</td>
                <td><img src="http://laravel-diplom-1.rdavydov.ru/storage/categories/appliance.jpg"
                         height="240px"></td>
            </tr>
            
            </tbody>
        </table>
    </div>
{{-- </div> --}}
@endsection