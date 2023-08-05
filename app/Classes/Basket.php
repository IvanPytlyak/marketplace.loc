<?php

namespace App\Classes;

use App\Models\Order;


class Basket
{
    protected $order;
    public function __construct()
    {
        $orderId = session('orderId');
        $this->order = Order::findOrFail($orderId);
    }
    public function getOrder()
    {
        return $this->order;
    }
    public function countAvailable()
    {
        foreach ($this->order->products as $product) {
            if ($product->count < $this->getPivotRow($product)->count) {
                return false;
            }
        }
    }
    public function getPivotRow($product)
    {
        return $this->order->products()->where('product_id', $product->id)->first()->pivot;
    }
}
