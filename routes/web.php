<?php

use App\Mail\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Admin\MymailController;
use App\Http\Controllers\OrderController as AdminOrderController;
use App\Http\Controllers\Person\OrderController as PersonOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/reset-password', ['Auth\ResetPasswordController@showResetForm'])->name('password.request');
// Route::get('/reset-password', ['Auth\ResetPasswordController@reset'])->name('password.update');







Route::get('/mail', function () {
    $recipient = 'mario38671@gmail.com';
    Mail::to($recipient)->send(new MailMessage('test', 'test'));
    return 'Отправлено';
});

Route::get('/open', [MymailController::class, 'index'])->name('open_email');
Route::post('/send', [MymailController::class, 'sendEmail'])->name('mail_send');

Auth::routes();

Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('get-logout');
Route::get('/reset', [ResetController::class, 'reset'])->name('reset');

Route::middleware(['auth'])->group(function () {

    Route::group([
        'prefix' => 'person',
        'as' => 'person.' // добавит имени роута 'person.home'/ person.orders.show во избежания одинаковых имен
    ], function () {
        Route::get('/orders', [PersonOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [PersonOrderController::class, 'show'])->name('orders.show');
    });


    Route::group([
        'prefix' => 'admin',
    ], function () {
        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('/orders', [AdminOrderController::class, 'index'])->name('home');

            Route::post('/orders/{order}/update', [AdminOrderController::class, 'update'])->name('orders_update_status'); // tut

            Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        });
        Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
        Route::resource('products', 'App\Http\Controllers\Admin\ProductController');

        Route::post('/{product}/images', 'App\Http\Controllers\ImagController@store')->name('image_store'); // множественная загрузка картинок
    });
});



Route::resource('reviews', 'App\Http\Controllers\ReviewController');
Route::get('reviews', 'App\Http\Controllers\ReviewController@index')->name('reviews_create');
// Route::post('reviews', 'App\Http\Controllers\ReviewController@store')->name('reviews_store'); // 13/07 изначальный (59 - тест)

Route::post('/products/{product}/reviews', 'App\Http\Controllers\ReviewController@store')->name('reviews_store');

Route::resource('imags', 'App\Http\Controllers\ImagController');
Route::post('imags', 'App\Http\Controllers\ImagController@store')->name('imags_store');
Route::get('imags', 'App\Http\Controllers\ImagController@index')->name('imags_create');

Route::post('/tg', [TelegramController::class, 'sendMessage'])->name('send_tg_messages');

// Route::get('/products/{productId}/comments', [ReviewController::class, 'index'])->name('reviews.index');

// Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth'); // проверка для маршрута

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/categories', [MainController::class, 'categories'])->name('categories');
Route::post('subscription/{product}', [MainController::class, 'subscribe'])->name('subscription');

Route::group([
    'middleware' => 'basket_is_not_empty',
    'prefix' => 'basket'
], function () {
    Route::get('/', [BasketController::class, 'basket'])->name('basket');
    Route::get('/place', [BasketController::class, 'basketPlace'])->name('basket-place');
    Route::post('/place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
    Route::post('/remove/{id}', [BasketController::class, 'basketRemove'])->name('basket-remove');
});
Route::match(['post', 'get'], 'basket/add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add');

Route::get('/{category}', [MainController::class, 'category'])->name('category');
Route::get('/{category}/{product?}', [MainController::class, 'product'])->name('product'); //  product? = может быть пустым
