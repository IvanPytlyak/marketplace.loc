<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ResetController extends Controller
{
    public function reset()
    {
        Artisan::call('migrate:fresh --seed'); // вызывает сброс БД и заполняет ее таблицами миграций и строками из сидеров

        foreach (['categories', 'products'] as $folder) { // опционально дабы не писать foreach дважды
            Storage::deleteDirectory($folder); // будет использовать public из filesustems.php // удаляет папку с содержимым
            Storage::makeDirectory($folder); // заново создает пустую папку в storage/app/public/$folder

            $files = Storage::disk('reset')->files($folder); // reset-соединение (куда вставить) из filesustems рукотворный
            foreach ($files as $file) {
                Storage::put($file, Storage::disk('reset')->get($file)); //Storage::put(), записывает содержимое файла на другой диск (в нашем случае, тот же диск 'reset').
                //Storage::disk('reset')->get($file) используется для получения содержимого файла на диске 'reset', а Storage::put($file, ...) записывает это содержимое на тот же диск.
                // это делается для того, чтобы обновить или перезаписать существующие файлы на этом диске.
            }
        }

        session()->flash('success', 'Проект был сброшен в начальное состояние');
        return redirect()->route('index');
    }
}
