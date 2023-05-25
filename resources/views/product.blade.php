@extends('master')
@section('content')


    <h1>{{$product->category->name}}</h1>

    <h2>{{$product->name}}</h2>
    <p>Цена: <b>{{$product->price}} руб.</b></p>
    <img src="{{Storage::url($product->image)}}" id="product_card_fix">
    <p>{{$product->description}}</p>

    <form action="{{route('basket-add', $product)}}" method="POST">
        @if ($product->isAvailable())
        <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        @else
        Не доступен
        @endif  
        @csrf
    </form>

@endsection 