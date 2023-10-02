<?php

namespace App\Models;

use App\Models\Imag;
use App\Models\Order;
use App\Models\Review;
use App\Models\Category;
use App\Classes\CurrencyConversion;
use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected  $fillable = [
        'code',
        'name',
        'description',
        'price',
        'image',
        'count',
        'updated_at',
        'created_at',
        'new',
        'hit',
        'recommend',
        'is_active',
        'name_en',
        'description_en'
    ];

    public function getCategory()
    {
        return Category::where('id', $this->category_id)->first();
        // $category = Category::find($this->category_id); // то же самое
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function images()
    {
        return $this->hasMany(Imag::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
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
    public function isAvailable()
    {
        return !$this->trashed() && $this->count > 0;
    }

    public function getPriceAttribute($value)
    {
        return round(CurrencyConversion::convert($value), 2);
    }
}
