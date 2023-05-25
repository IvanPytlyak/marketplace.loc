@extends('layouts.app')

@section('title', 'Товары')

@section('content')
{{-- <div class="row justify-content-center"> --}}
  
    <div class="col-md-12">
        {{-- <div class="col-md-12"> и удалить  <div class="row justify-content-center"> --}}
        <h1 id="h1_fix">Товары</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Код
                </th>
                <th>
                    Название
                </th>
                <th>
                    Категория
                </th>
                <th>
                    Цена
                </th>
                <th>
                    Количество
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->count}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                {{--  route('categories.destroy', $category) указан как иcключение т.к. для открыть/редактировать роуты прописаны --}}
                                <a class="btn btn-success" type="button" href="{{ route('products.show', $product) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('products.edit', $product) }}">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links('pagination::bootstrap-4') }}
        <a class="btn btn-success" type="button"
           href="{{ route('products.create') }}">Добавить товар</a>
        </div>
@endsection