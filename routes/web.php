<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController as AdminOrderController;
use App\Http\Controllers\Person\OrderController as PersonOrderController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ResetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/', function () {
//     return view('index'); // view/index.blade.php
// });







Auth::routes([
    // 'reset' => false, // в  случае reset установлено в false, что означает, что маршруты для сброса пароля не будут созданы.
    // 'confirm' => false,
    // 'verify' => false
]);


Route::get('reset', [ResetController::class, 'reset'])->name('reset');



// Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');
Route::get('/logout',  [LoginController::class, 'logout'])->name('get-logout');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () { // проверка на авторизацию пользователя/ необходимо для разделения админ/не админ/не авторизированный
    Route::group([
        'prefix' => 'person', //определяет префикс (prefix) для URL-адресов
        'namespace' => 'Person',
        'as' => 'person.', // определяет префикс (prefix) для именованных маршрутов
    ], function () {
        Route::get('/orders', [PersonOrderController::class, 'index'])->name('orders.index'); // на данный момент реализован в методе контроллера
        Route::get('/orders/{order}', [PersonOrderController::class, 'show'])->name('orders.show');
    });

    Route::group(
        [
            // 'middleware' => 'auth', // авторизованный пользователь
            // 'namespace' => 'Admin',
            'prefix' => "admin", // пересечение роутов route:list

        ],
        function () {
            Route::group(['middleware' => 'is_admin'], function () { // вторая проверка по 'middleware' / пользователь авторизирован/ он админ
                Route::get('/orders', [AdminOrderController::class, 'index'])->name('home'); // на данный момент реализован в методе контроллера
                Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
            });
            Route::resource('categories', 'App\Http\Controllers\CategoryController'); //  ресурсный именованный маршрут
            Route::resource('products', 'App\Http\Controllers\ProductController'); //  ресурсный именованный маршрут
        }
    );
});




## передаем перечень роутов в функцию для допуска к роутингу только авторизированных пользователей

Route::post('/bascet/add/{product}', [BasketController::class, 'basketAdd'])->name('basket-add'); // не в групппе т.к. не даст добавлять товары в корзину // id заменен на product, т.к. в bascetController изменен атрибут передающийся в функцию basketAdd(product) на basketAdd(Product product) и теперь в роут прокидываем id продукта через product  
// Route::post('/bascet/add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add'); // было 
Route::group([
    'middleware' => 'basket_note_empty',
    // 'prefix' => 'bascet' // дает возможность в нижних роутах убрать постоянную часть 'basket'
], function () {
    Route::post('/bascet/remove/{product}', [BasketController::class, 'basketRemove'])->name('basket-remove'); // аналогично роуту add (смотри описание)
    Route::get('/basket', [BasketController::class, 'basket'])->name('basket');
    Route::get('/basket/place', [BasketController::class, 'basketPlace'])->name('basket-place');
    Route::post('/basket/place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
});

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/categories', [MainController::class, 'categories'])->name('categories');
Route::get('/{category}', [MainController::class, 'category'])->name('category');
Route::get('/{category}/{product}', [MainController::class, 'product'])->name('product');
