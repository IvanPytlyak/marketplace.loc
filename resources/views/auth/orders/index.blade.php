@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
            <h1 id="h1_fix">Заказы</h1>
            <table class="table">
                <tbody>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Имя
                    </th>
                    <th>
                        Телефон
                    </th>
                    <th>
                        Когда отправлен
                    </th>
                    <th>
                        Сумма
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->created_at->format('H:i d.m.Y')}}</td>
                            <td>{{$order->getFullPrice()}}</td>

                            <td>
                                <div class="btn-group" role="group">
                                    <a 
                                    @admin
                                        href="{{route('orders.show', $order)}}"
                                    @else
                                        href="{{route('person.orders.show', $order)}}"
                                    @endadmin       
                                    class="btn btn-success" type="button">Открыть</a> 
                                </div>
                            </td>
                        </tr>
                    @endforeach       
                </tbody>

            </table>
        
        </div>
    </div>
</div>
{{$orders->links('pagination::bootstrap-4')}}
@endsection