<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();
        // $orderId = session('orderId'); // 2-ым этапом  убрана после введения   $order = new Basket();
        // if (!is_null($orderId)) { // в middleware Basketnotempty уже задано условие, что корзина не пуста  // 1-ым этапом  убрана
        // $order = Order::findOrFail($orderId);  // 2-ым этапом  убрана после введения   $order = new Basket();
        // }

        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        // $orderId = session('orderId');
        // if (is_null($orderId)) { // в middleware Basketnotempty уже задано условие, что корзина не пуста
        //     return redirect()->route('index');
        // }
        // $order = Order::findOrFail($orderId);
        $order = (new Basket())->getOrder();
        return view('order', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        // $orderId = session('orderId');
        // if (is_null($orderId)) { // в middleware Basketnotempty уже задано условие, что корзина не пуста
        //     return redirect()->route('index');
        // }
        // $order = Order::findOrFail($orderId);
        // $order = (new Basket())->saveOrder($request->name, $request->phone);

        // $succsess = $order->saveOrder($request->name, $request->phone); // тут saveOrder 
        if ((new Basket())->saveOrder($request->name, $request->phone)) { // ранее было if ($succsess)
            session()->flash('success', 'Ваш заказ принят в обработку');
        } else {
            session()->flash('warning', 'Случилась ошибка');
        }
        return redirect()->route('index');
    }


    public function basketAdd(Product $product) // $productId
    {
        $orderId = session('orderId'); // как это работает? 'orderId'? // =если сессия активна?
        if (is_null($orderId)) { // не проходим через middleware поэтому не удаляем
            $order = Order::create(); //  стояло  $order = Order::create()->id;
            session(
                ['orderId' => $order->id,]
            );
        } else {
            $order = Order::findOrFail($orderId);
        }
        if ($order->products->contains($product->id)) {  // Laravel contains() и containsStrict(): проверьте, содержит ли коллекция Laravel значение Value  
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot; //->pivot дает доступ к данным определенным модели при расширеной связи по belongsToMany 
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($product->id); //attach добавляет полученный productId в таблицу products->id
        }
        // return view('basket', compact('order'));

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        // $product = Product::find($productId);
        session()->flash('success', 'Добавлен товар ' . $product->name);
        return redirect()->route('basket'); // редирект,теперь при обновлении страницы не срабатывает повторное добавление товара
    }

    public function basketRemove(Product $product)
    {
        $basket = new Basket();
        $orderId = session('orderId');
        // if (is_null($orderId)) {    // в middleware Basketnotempty уже задано условие, что корзина не пуста
        //     return redirect()->route('basket');
        // }
        $order = Order::findOrFail($orderId);

        if ($order->products->contains($product->id)) {  // Laravel contains() и containsStrict(): проверьте, содержит ли коллекция Laravel значение Value  
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot; //->pivot дает доступ к данным определенным модели при расширеной связи по belongsToMany 
            if ($pivotRow->count < 2) {
                $order->products()->detach($product->id); // products() - метод Order = $order->products->id // поиск по связанной таблице и удаление

            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        // $product = Product::findOrFail($productId);
        session()->flash('warning', 'Удален товар ' . $product->name);
        return redirect()->route('basket');
    }
}
