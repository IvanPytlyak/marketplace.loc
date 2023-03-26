<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Auth\LoginController;


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
Auth::routes();
// Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');
Route::get('/logout',  [LoginController::class, 'logout'])->name('get-logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); // на данный момент реализован в методе контроллера
// });
## передаем перечень роутов в функцию для допуска к роутингу только авторизированных пользователей



Route::post('/bascet/add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add');
Route::post('/bascet/remove/{id}', [BasketController::class, 'basketRemove'])->name('basket-remove');
Route::get('/basket', [BasketController::class, 'basket'])->name('basket');
Route::get('/basket/place', [BasketController::class, 'basketPlace'])->name('basket-place');
Route::post('/basket/place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/categories', [MainController::class, 'categories'])->name('categories');
Route::get('/{category}', [MainController::class, 'category'])->name('category');
Route::get('/{category}/{product}', [MainController::class, 'product'])->name('product');
