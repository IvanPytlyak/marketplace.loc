<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'code',
        'image',
        'price',
        'new',
        'hit',
        'recommend'
    ];

    public function getCategory() // почему-то бьет ошибку хотя не используется
    {
        return Category::find($this->category_id);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount($count)
    {
        return $this->price * $count;
    }

    public function isHit()
    {
        return $this->hit === 1;
    }
    public function isNew()
    {
        return $this->new === 1;
    }
    public function isRecommend()
    {
        return $this->recommend === 1;
    }
}
