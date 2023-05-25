<?php

namespace App\Http\Controllers;

use DebugBar\DebugBar;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
// use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Requests\ProductsFilterRequest;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {
        // dd(($request->ip())); // узнаем ip

        // Log::channel('daily')->info($request->ip()); //логирование ip // по выбранному маршруту single -пишет все в один файл, daily- каждый день новый файл, info/error/warninh- типы, определен в config/logging.php, IP() -дефолтный метод

        // \Debugbar::info('my info'); // '\'- нужно добавлять (баг)

        $productsQuery = Product::query(); // n+1
        // $productsQuery = Product::with('category'); // оптимизация запроса, группирует все данные category в коллекцию и сверяет по всей коллекции а не по-элементно как на строку выше

        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from); //фильтр условие
        }
        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to); //фильтр условие
        }

        // foreach (['hit', 'new', 'recommend'] as $field) {
        //     if ($request->has($field)) {
        //         $productsQuery->where($field, 1);
        //     // } else {
        //     //     $productsQuery->orWhere($field, 0);
        //     // }
        // }

        if ($request->has('hit')) {
            $productsQuery->where('hit', 1);
        }
        if ($request->has('new')) {
            $productsQuery->where('new', 1);
        }
        if ($request->has('recommend')) {
            $productsQuery->where('recommend', 1);
        }

        // if ($request->has('recommend')) { // аналог
        //     $productsQuery->where('recommend', 1);
        // }



        $products = $productsQuery->paginate(6); //->appends(request()->query()); //->withPath("?" . $request->getQueryString()); // =get() с фиксированным / withPath позволяет переносить значения фильтров на другую страницу путем добавления пагинации страниц в get запрос. ->getQueryString() дефолтный метод
        // $urlWithFilters = url()->current() . '?' . http_build_query($request->except('page')); // http_build_query — Генерирует URL-кодированную строку запроса // Метод except возвращает все элементы коллекции, кроме тех, у которых есть указанные ключи:
        // $products->withPath($urlWithFilters);
        // $products->withPath("?" . $request->getQueryString());
        return view('index', compact('products'));
    }

    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
        // $products = Product::where('category_id', $category->id)->get();
        // return view('category', compact('category', 'products')); // алиас compact = ['product' => $product]);
        return view('category', compact('category'));
        // dd($category);
    }

    public function product($category, $productCode) // в отличии от category если сделать аналогично, вернет просто 1 продукт вместо объекта, поэтому нужно через scoupe перенастроить запрос к БД 
    {
        $product = Product::withTrashed()->byCode($productCode)->first(); //withTrashed()-> с учетом удаленных
        return view('product', compact('product'));
    }
}
