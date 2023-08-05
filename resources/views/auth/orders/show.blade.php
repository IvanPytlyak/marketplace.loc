@extends('layouts.app')

@section('title', 'Заказ ' . $order->id)

@section('content')
    
        <div class="py-4">
            <div class="container">
                <div class="justify-content-center">
                    <div class="panel">
                        <h1>Заказ № {{$order->id}}</h1>
                        <p>Заказчик: &nbsp <b>{{$order->name}}</b></p>
                        <p>Номер телефона: &nbsp <b>{{$order->phone}}</b></p>
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
                                @foreach ($products as $product)                   
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

                    <div class="col-sm-5">
                        @admin
                            <form method="POST" enctype="multipart/form-data" action="{{route('orders_update_status', $order)}}">
                                @csrf
                                    
                                    <div class="form-group row">
                                        <label for="check" class="col-sm-5 col-form-label">Статус заказа: &nbsp &nbsp
                                            @if (isset($order) && $order->isProcessed())
                                               <b>Выполнен</b> 
                                            @else
                                                <b>В обработке</b> 
                                            @endif
                                        </label>

                                        
                                        <div class="form-check form-switch col-sm-5 col-form-label">
                                            <input class="form-check-input" type="checkbox" id="is_processed" name="is_processed"
                                            @if(isset($order) && $order->isProcessed())
                                                checked="checked"
                                            @endif
                                            >
                                        </div>                        
                                        <div class="col-sm-2">
                                        <button type="submit" class="btn btn-success">Сохранить</button>
                                        </div>                                   
                                    </div>                                      
                            </form>
                        @endadmin 
                    </div>  

                    </div>
                </div>
            </div>
        </div>
   
@endsection


