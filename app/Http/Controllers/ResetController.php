<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ResetController extends Controller
{
    public function reset()
    {
        Artisan::call('migrate:fresh --seed'); //сброс БД

        Storage::deleteDirectory('categories'); // Для categories определен дефолтный путь сохранения как public in env/ filesystem
        Storage::makeDirectory('categories');
        $files = Storage::disk('reset')->files('categories'); // $files=  массив файлов
        foreach ($files as $file) {
            Storage::put($file, Storage::disk('reset')->get($file)); // put сохраняет фалы, 1 арг - имя файла в который нужно скопировать данные , 2ой - сами данные
        } // копирует данные из файла $file на дискеи копирует их в файл с тем же именем на текущем диске (т.е. publick)

        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        $productsFiles = Storage::disk('reset')->files('products');
        foreach ($productsFiles as $productsFile) {
            Storage::put($productsFile, Storage::disk('reset')->get($productsFile));
        }

        session()->flash('success', 'Проект был сброшен в начальное состояние');
        return redirect()->route('index');
    }
}
