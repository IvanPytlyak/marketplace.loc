<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imag extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'product_id',
        'updated_at',
        'created_at',
        'imags.name'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
