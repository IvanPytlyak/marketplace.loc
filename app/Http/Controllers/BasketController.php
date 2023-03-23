<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
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
        return view('order', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $succsess = $order->saveOrder($request->name, $request->phone);
        if ($succsess) {
            session()->flash('success', 'Ваш заказ принят в обработку');
        } else {
            session()->flash('warning', 'Случилась ошибка');
        }
        return redirect()->route('index');
    }


    public function basketAdd($productId)
    {
        $orderId = session('orderId'); // как это работает? 'orderId'?
        if (is_null($orderId)) {
            $order = Order::create(); //  стояло  $order = Order::create()->id;
            session(
                ['orderId' => $order->id,]
            );
        } else {
            $order = Order::find($orderId);
        }
        if ($order->products->contains($productId)) {  // Laravel contains() и containsStrict(): проверьте, содержит ли коллекция Laravel значение Value  
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot; //->pivot дает доступ к данным определенным модели при расширеной связи по belongsToMany 
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId); //attach добавляет полученный productId в таблицу products->id
        }
        // return view('basket', compact('order'));
        $product = Product::find($productId);
        session()->flash('success', 'Добавлен товар ' . $product->name);
        return redirect()->route('basket'); // редирект,теперь при обновлении страницы не срабатывает повторное добавление товара
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {  // Laravel contains() и containsStrict(): проверьте, содержит ли коллекция Laravel значение Value  
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot; //->pivot дает доступ к данным определенным модели при расширеной связи по belongsToMany 
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId); // products() - метод Order = $order->products->id // поиск по связанной таблице и удаление

            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);
        session()->flash('warning', 'Удален товар ' . $product->name);
        return redirect()->route('basket');
    }
}
