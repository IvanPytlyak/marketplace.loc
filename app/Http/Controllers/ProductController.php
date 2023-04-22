<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10); //для разбиения результатов запроса на страницы
        return view('auth.products.index', compact('products'));
        // $products = Product::get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('auth.products.form', compact('categories')); // роут на форму для создания
    }
    // Метод create() в контроллере используется для отображения формы создания нового ресурса. Этот метод возвращает вид, содержащий HTML-код формы, которая позволяет пользователю ввести информацию о новом товаре. После заполнения и отправки этой формы данные обрабатываются методом store()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) //Request  --->> ProductRequest //создание нового продукта
    {
        $params = $request->all();
        unset($params['image']);

        if ($request->has('image')) { // если в запросе передается image
            $path = $request->file('image')->store('products'); //путь к созданному файлу /'image'- название поля из формы отправки стр 56 form.blade / store('categories') сохраняет в папку categories // если папки нет то ее создаст
            $params['image'] = $path; // image -это уже столбец из БД
        }

        // foreach (['hit', 'new', 'recommend'] as $fieldName) { // Мутатор настроен аналогично update, поэтому можно удалить
        //     if (isset($params[$fieldName])) {
        //         $params[$fieldName] = 1;
        //     }
        // }; // нужно иметь в виду того, что чекбокс возвращает значение 'on' а не 1

        Product::create($params);
        // Product::create($request->all()); // из POST обработки все данные закинули в таблицу категорий (создание позиций)
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('auth.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('auth.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product) //Request  --->> ProductRequest
    {
        $params = $request->all();
        unset($params['image']);

        if ($request->has('image')) {
            Storage::delete($product->image); // Удалили из папки картинку
            $path = $request->file('image')->store('products'); //путь к созданному файлу /'image'- название поля из формы отправки стр 56 form.blade / store('categories') сохраняет в папку categories
            $params['image'] = $path; // image -это уже столбец из БД
        }

        // foreach (['hit', 'new', 'recommend'] as $fieldName) { // Мутатор, аналог кода описан в product.php методах setNewAttribute/setHitAttribute/setRecommendAttribute 
        //     if (isset($params[$fieldName])) {
        //         $params[$fieldName] = 1;
        //     } else {
        //         $params[$fieldName] = 0;
        //     }
        // };
        foreach (['hit', 'new', 'recommend'] as $fieldName) {
            if (!isset($params[$fieldName])) {
                $params[$fieldName] = 0;
            }
        };

        $product->update($params);
        // $product->update($request->all());
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
