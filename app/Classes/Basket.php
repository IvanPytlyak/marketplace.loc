<?php

namespace App\Classes;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Basket
{
    protected $order;

    public function __construct($createOrder = false)
    {
        $orderId = session('orderId');
        if (is_null($orderId) && $createOrder) { // не проходим через middleware поэтому не удаляем
            $data = [];
            if (Auth::check()) {
                $data['user_id'] = Auth::id();
            }
            $this->order = Order::create($data); //  стояло  $order = Order::create()->id;
            session(['orderId' => $this->order->id]);
        } else {
            $this->order = Order::findOrFail($orderId);
        }
    }
    protected function getPivotRow($product)
    {
        return $this->order->products()->where('product_id', $product->id)->first()->pivot;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function saveOrder($name, $phone)
    {
        if (!$this->countAvalible(true)) {
            return false;
        }
        return $this->order->saveOrder($name, $phone); // вызывает не сам себя а метод Order Model просто название одинаковое

    }


    public function countAvalible($updateCount = false)
    {
        foreach ($this->order->products as $orderProduct) {
            if ($orderProduct->count < $this->getPivotRow($orderProduct)->count) { // кол-во из БД и количество в корзине сравниваем
                return false;
            }
            if ($updateCount) {
                $orderProduct->count -= $this->getPivotRow($orderProduct)->count;
            }
        }
        if ($updateCount) {
            $this->order->products->map->save();
        }
        return true;
    }
    public function removeProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) {  // Laravel contains() и containsStrict(): проверьте, содержит ли коллекция Laravel значение Value  
            $pivotRow = $this->getPivotRow($product); //->pivot дает доступ к данным определенным модели при расширеной связи по belongsToMany 
            if ($pivotRow->count < 2) {
                $this->order->products()->detach($product->id); // products() - метод Order = $order->products->id // поиск по связанной таблице и удаление

            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        // логирование суммы
    }
    public function addProduct(Product $product)
    {

        if ($this->order->products->contains($product->id)) {  // Laravel contains() и containsStrict(): проверьте, содержит ли коллекция Laravel значение Value  
            $pivotRow =  $this->getPivotRow($product); //->pivot дает доступ к данным определенным модели при расширеной связи по belongsToMany 
            if ($pivotRow->count >= $product->count) {
                return false;
            }
            $pivotRow->count++;
            $pivotRow->update(); // по связи переменной обновляет БД?
        } else {
            if ($product->count == 0) {
                return false;
            }
            $this->order->products()->attach($product->id); //attach добавляет полученный productId в таблицу products->id
        }
        // return view('basket', compact('order'));

        return true;
    }
    // логирование суммы
}
