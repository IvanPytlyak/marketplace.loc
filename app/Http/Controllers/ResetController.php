<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ResetController extends Controller
{
    public function reset()
    {
        Artisan::call('migrate:fresh --seed'); // вызывает сброс БД и заполняет ее таблицами миграций и строками из сидеров
        session()->flash('success', 'Проект был сброшен в начальное состояние');
        return redirect()->route('index');
        // dd(1);
    }
}
