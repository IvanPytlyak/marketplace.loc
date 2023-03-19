<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
        return view('category', compact('category')); // алиас compact = ['product' => $product]);
        // dd($category);
    }

    public function product($product, $category)
    {
        // dump($product); //dd(request())
        return view('product', ['product' => $product]);
    }

    public function basket()
    {
        return view('basket');
    }

    public function basketPlace()
    {
        return view('order');
    }
}
