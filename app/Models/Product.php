<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function getCategory() // почему-то бьет ошибку хотя не используется
    {
        return Category::find($this->category_id);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
