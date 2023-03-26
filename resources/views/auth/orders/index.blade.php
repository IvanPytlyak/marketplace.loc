{{-- @extends('master') --}}
@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
    <div class="col-md-12">
        <h1>Заказы</h1>
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
            {{-- @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id}}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" type="button"
                               @admin
                               href="{{ route('orders.show', $order) }}"
                               @else
                               href="{{ route('person.orders.show', $order) }}"
                                @endadmin
                            >Открыть</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody> --}}
            <tr>
                <td>#</td>
                <td>Ivan</td>
                <td>5054245747</td>
                <td>26.03.2023 23:26</td>
                <td>1000</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="#" class="btn btn-success" type="button">Открыть</a>
                    </div>
                </td>
            </tr>
        </table>
        {{-- {{ $orders->links() }} --}}
    </div>
@endsection