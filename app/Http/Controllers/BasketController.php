<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return view('basket');
    }

    public function basketPlace()
    {
        return view('order');
    }
    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create()->id;
            session(
                [
                    'orderId' => $order->id,
                ]
            );
        } else {
            $order = Order::find($orderId);
        }
        $order->products()->attach($productId); //attach добавляет полученный productId в таблицу products->id
        return view('basket', compact('order'));
    }
}
