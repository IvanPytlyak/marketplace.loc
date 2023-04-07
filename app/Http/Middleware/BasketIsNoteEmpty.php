<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use Illuminate\Http\Request;

class BasketIsNoteEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $orderId = session('orderId'); //orderId - идентификатор заказа, можно написать что угодно
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
            if ($order->products->count() > 0) {
                return $next($request); // Это означает, что если заказ существует в сессии и не содержит продуктов, то цепочка middleware перейдет к следующему middleware или к обработке запроса, если более нет промежуточных обработчиков.
            }
        }
        session()->flash('warning', 'Ваша корзина пуста');
        return redirect()->route('index');
    }
}
