<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::query();

        if ($request->filled('hit')) {
            $productsQuery->where('hit', '=', '1');
        }
        if ($request->filled('new')) {
            $productsQuery->where('new', '=', '1');
        }
        if ($request->filled('recommend')) {
            $productsQuery->where('recommend', '=', '1');
        }

        // if ($request->has('recommend')) { // аналог
        //     $productsQuery->where('recommend', 1);
        // }

        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from); //фильтр условие
        }
        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to); //фильтр условие
        }

        $products = $productsQuery->paginate(6); //->withPath("?" . $request->getQueryString()); // =get() с фиксированным / withPath позволяет переносить значения фильтров на другую страницу путем добавления пагинации страниц в get запрос. ->getQueryString() дефолтный метод
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

    public function product($product, $category)
    {
        // dump($product); //dd(request())
        return view('product', ['product' => $product]);
    }
}
