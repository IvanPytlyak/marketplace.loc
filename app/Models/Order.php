<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_processed',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }
    public function getFullPrice()
    {
        $sum = 0;
        foreach ($this->products()->withTrashed()->get() as $product) { //softDelete
            $sum += $product->getPriceForCount($product->pivot->count);
        }
        return $sum;
    }
    public function saveOrder($request)
    {
        if ($this->status == 0) {
            $this->status = 1;
            $this->name = $request->name;
            $this->phone = $request->phone;
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
    }

    public function isProcessed()
    {
        return $this->is_processed === 1;
    }
}
