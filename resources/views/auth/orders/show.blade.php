@extends('layouts.app')

@section('title', 'Заказ ' . $order->id)

@section('content')
    
        <div class="py-4">
            <div class="container">
                <div class="justify-content-center">
                    <div class="panel">
                        <h1>Заказ № {{$order->id}}</h1>
                        <p>Заказчик: <b>{{$order->name}}</b></p>
                        <p>Номер телефона: <b>{{$order->phone}}</b></p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Кол-во</th>
                                <th>Цена</th>
                                <th>Стоимость</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->products as $product)                   
                                <tr>
                                    <td>
                                        <a href="{{route('product', [$product->category->code, $product->code])}}">
                                            <img id="imagefix_order"  src="{{Storage::url($product->image)}}" alt="{{$product->name}}">
                                            {{$product->name}}
                                        </a>
                                    </td>
                                    <td><span class="badge"></span> {{$product->pivot->count}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->getPriceForCount($product->pivot->count)}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Общая стоимость:</td>
                                <td>{{$order->getFullPrice()}}</td>
                            </tr>
                        
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
   
@endsection


