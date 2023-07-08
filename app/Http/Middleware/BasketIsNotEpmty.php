<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasketIsNotEpmty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            // $order = Order::findOrFail($orderId);
            $order = Order::find($orderId);

            if (is_null($order)) {
                // $order = Order::findOrFail($orderId);
                session()->forget('orderId');
            } else {
                if ($order->products()->count() > 0) {
                    return $next($request); // продолжение выполнения
                }
            }
            // dd($order->products);

        };
        session()->flash('warning', 'Ваша корзина пуста');
        return redirect()->route('index');
    }
}
