@extends('layouts.app')

@section('title', 'Товар ' . $product->name)

@section('content')
{{-- <link href="/css/bootstrap.min.css" rel="stylesheet"> --}}

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
                <td><img id="imagefix" src="{{Storage::url($product->image)}}"
                         ></td>
            </tr>
            <tr>
                <td>Лейблы</td>
                <td>
                    @if ($product->isNew())
                    <span class="badge badge-success">Новинка</span>
                @endif
                @if ($product->isRecommend())
                    <span class="badge badge-warning">Рекомендуемые</span>
                @endif
                @if ($product->isHit())
                    <span class="badge badge-danger">Хит продаж</span>
                @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
{{-- </div> height="240px"--}}
@endsection