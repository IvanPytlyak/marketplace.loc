<?php

namespace App\Http\Controllers\Person;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class OrderController extends Controller
{

    public function index() // отображение всех заказов // index - blade
    {
        $orders = Auth::user()->orders()->where('status', 1)->get(); // orders() метод user
        return view('auth.orders.index', compact('orders'));
    }

    public function show(Order $order) // show- blade
    {
        if (Auth::user()->orders->contains($order)) {
            return back(); // если не содержит заказ возвращаем
        }; //contains - это метод коллекции в Laravel, который проверяет, содержит ли коллекция заданный элемент.
        return view('auth.orders.show', compact('order'));
    }
}
