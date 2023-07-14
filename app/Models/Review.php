<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'product_id',
        'updated_at',
        'created_at',
        'description'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
