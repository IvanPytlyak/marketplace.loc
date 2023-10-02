<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    // public function scopeByCode($query, $code)
    // {
    //     return $query->where('code', $code);
    // }

    public function scopeByCode($query, $code, $date)
    {
        return $query->where('code', $code)->where('date', $date);
    }

    public function getUsd()
    {
        return $this->ByCode('USD', Carbon::now()->toDateString())->firstOrFail();
    }
}
