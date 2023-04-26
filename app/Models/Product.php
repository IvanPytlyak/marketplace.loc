<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes; //добавляем метод "мягкого удаления" через трейт

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'code',
        'image',
        'price',
        'new',
        'hit',
        'recommend',
        'count'
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

    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
        // $value = on
        // = нижеуказанному коду из productController/update
        // foreach (['hit', 'new', 'recommend'] as $fieldName) {
        //     if (isset($params[$fieldName])) {
        //         $params[$fieldName] = 1;
        //     } else {
        //         $params[$fieldName] = 0;
        //     }
        // };
    }
    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }
    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }
    public function setNewdAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function isAvailable()
    {
        // $this->trashed(); // показывает является ли удаленным
        return !$this->trashed() && $this->count > 0; //условие возвращает 0 if true
    }

    public function scopeByCode($query, $code) // scoup Внутрь скоупа передаётся запрос, на который можно навешивать дополнительные условия. Результатом работы любого скоупа должен быть скоуп
    { // scope -слово-вызов  ByCode =рандомное имя функции
        //$query - экземпляр запроса
        return $query->where('code', $code);
    }
}
