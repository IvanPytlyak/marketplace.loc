<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::where('status', 1)->paginate(10);
        return view('auth.orders.index', compact('orders'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function show(Order $order)
    {
        return view('auth.orders.show', compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        $params = $request->all();

        if ($params['is_processed']) {
            $params['is_processed'] = 1; // on
        } else {
            $params['is_processed'] = 0;
        }

        $order->update($params);
        return redirect()->route('home');
    }
}
