<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Translatable;

    protected  $fillable = [
        'code',
        'name',
        'description',
        'updated_at',
        'created_at',
        'image',
        'name_en',
        'description_en'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
