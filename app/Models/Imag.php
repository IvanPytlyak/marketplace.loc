<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
