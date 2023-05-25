{{-- @extends('master') --}}
@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
{{-- <div class="row justify-content-center"> --}}
    {{-- 7 -delete/ 9-col-md-12 --}}
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
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id}}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td>{{ $order->getFullPrice() }} </td>
                    {{-- {{ $order->currency->symbol }} --}}
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" type="button"
                            @admin
                            {{-- 'admin' - пользовательская, в AppServiceProvider место  @if (Auth::user()->isAdmin())--}}
                                href="{{route('orders.show', $order)}}"
                            @else
                                href="{{route('person.orders.show', $order)}}"
                            @endadmin
                            >Открыть</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
       {{ $orders->links('pagination::bootstrap-4')}}
      
    </div>
{{-- </div> --}}
@endsection