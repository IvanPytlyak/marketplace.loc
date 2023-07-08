<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected  $fillable = [
        'code',
        'name',
        'description',
        'updated_at',
        'created_at',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
