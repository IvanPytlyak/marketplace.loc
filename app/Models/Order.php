<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps(); // withPivot позволяет вызывать count через связи
    }
    public function getFullPrice()
    {
        $summ = 0;
        foreach ($this->products as $product) {
            $summ += $product->getPriceForCount($product->pivot->count);
        }
        return $summ;
    }
}
