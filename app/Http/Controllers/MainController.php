<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::get();
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
