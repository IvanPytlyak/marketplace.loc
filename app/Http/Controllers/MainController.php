<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function categories()
    {
        return view('categories');
    }

    public function category($category)
    {
        return view('category', compact('category')); // алиас compact = ['product' => $product]);
        // dd($category);
    }

    public function product($product)
    {
        // dump($product); //dd(request())
        return view('product', ['product' => $product]);
    }
}
