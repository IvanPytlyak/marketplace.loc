<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Classes\Basket;
use App\Models\Product;
use App\Mail\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\isNull;

class BasketController extends Controller
{
    public function basket()
    {
        // session()->forget('success'); // не отрабатывает
        // $successMessage = session('success');
        // dd($successMessage);


        $order = (new Basket())->getOrder();
        // $orderId = session('orderId');
        // $order = Order::find($orderId); // ==  $basket = new Basket();

        // if (!is_null($orderId)) {
        if (is_null($order)) {
            // $order = Order::findOrFail($orderId);
            session()->forget('orderId');
        }



        return view('basket', compact('order'));
    }
    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);

        // $basket = new Basket();
        // $order = $basket->getOrder();
        // if (!$basket->countAvailable()) {
        //     session()->flash('warning', 'Товар не доступен для заказа в полном объеме.');
        //     return redirect()->route('basket');
        // }

        return view('order', compact('order'));
    }

    public function basketAdd($productId)
    {
        $product = Product::find($productId);

        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            // dd($pivotRow);
            if ($pivotRow->count > $product->count) {
                return redirect(route('basket'))->with('warning', 'Товар ' . $product->name . ' в большем количестве не доступен для заказа.');
            }
            $pivotRow->update();
        } else {
            if ($product->count == 0) {
                return redirect(route('basket'))->with('warning', 'Товар ' . $product->name . ' в большем количестве не доступен для заказа.');
            }
            $order->products()->attach($productId);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        session()->flash('success', 'Товар ' .  $product->name . ' успешно добавлен.');
        return redirect(route('basket'));
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect(route('basket'));
        }
        $order = Order::find($orderId);
        if ($order->products->contains($productId)) {

            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);
        session()->flash('warning', 'Товар ' .  $product->name . ' удален.');
        return redirect(route('basket'));
    }

    public function basketConfirm(Request $request)
    {

        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }

        $order = Order::find($orderId);

        foreach ($order->products as $product) {
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
            if ($product->count < $pivotRow->count) {
                session()->flash('warning', 'Товар ' . $product->name . ' не доступен для заказа в полном объеме.');
                return redirect()->route('basket');
            }
            $product->count -= $pivotRow->count;
            $product->save();
        }


        $email = Auth::check() ? Auth::user()->email : $request->email;       // + в модели order метод saveOrder передан email

        $basket = new Basket();
        // Mail::to($email)->send(new OrderCreated($request->name, $basket));      // ошибка т.к. Basket $basket определен толлько в OrderCreated, на данный  момент не понимает к чему тут This
        // $succsess = $order->saveOrder($request);

        $succsess = $order->saveOrder($request, $email);

        Mail::to($email)->send(new OrderCreated($request->name, $basket->getOrder()));
        // $succsess = $order->saveOrder($request, $email);                      //

        if ($succsess) {
            session()->flash('success', 'Ваш заказ принят в обработку');
        } else {
            session()->flash('warning', 'Товар не доступен для заказа в полном объеме.');
        }
        return redirect()->route('index');
    }
}
