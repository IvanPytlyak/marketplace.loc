<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);

        return view('auth.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('auth.products.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $params = $request->all();
        if ($request->has('image')) {
            $path = $request->file('image')->store('products'); // file('image')- получает имя файла/ store('products') -сохраняет файл в папку products и возвращает путь
            $params['image'] = $path;
        };

        // foreach (['hit', 'new', 'recommend'] as $field) { // передает "on"
        //     if (isset($params[$field])) {
        //         $params[$field] = 1;
        //     }
        // };
        foreach (['hit', 'new', 'recommend', 'is_active'] as $field) { // передает "on"
            if (isset($params[$field])) {
                $params[$field] = 1;
            }
        };

        Product::create($params);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('auth.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('auth.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $params = $request->all();

        // dd($params);

        unset($params['image']);
        if ($request->has('image')) {
            Storage::delete($product->image);
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
        }

        foreach (['hit', 'new', 'recommend', 'is_active'] as $field) {

            if (isset($params[$field])) {
                $params[$field] = 1; // on
            } else {
                $params[$field] = 0;
            }
        }

        $product->update($params);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }


    // public function showComments($prodictId)
    // {
    //     $product = Product::findOrFai($prodictId);
    //     $comments = $product->reviews;
    //     return view('auth.products.index', compact('products'));
    // }
}
