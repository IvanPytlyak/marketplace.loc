<?php

namespace App\Http\Controllers;

use App\Models\Imag;
use GuzzleHttp\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsFilterRequest;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {
        // $client = new \GuzzleHttp\Client();
        // $currencyRequest = $client->request('GET', 'https://api.nbrb.by/exrates/currencies'); // 19/6 - EUR, 145/68 - USD, 141/65 - RUB
        // $currencyResponse = json_decode($currencyRequest->getBody()->getContents()); // полный перечень валют
        // $usd = $currencyResponse['68'];
        // $eur = $currencyResponse['6'];
        // $rub = $currencyResponse['65'];

        $client = new \GuzzleHttp\Client();
        $currencyRequest = $client->request('GET', 'https://api.nbrb.by/exrates/rates?periodicity=0&parammode=19');
        $currencyResponse = json_decode($currencyRequest->getBody()->getContents());
        // eur - 9 / usd -7 / rub - 21
        $usd = $currencyResponse[7]->Cur_OfficialRate;
        $eur = $currencyResponse[9]->Cur_OfficialRate;
        $rub = $currencyResponse[21]->Cur_OfficialRate;

        $productsQuery = Product::query(); // Product::query() - обращение к бд таблице продуктов

        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }
        if ($request->filled('hit')) {
            $productsQuery->where('hit', 1);
        }
        if ($request->filled('new')) {
            $productsQuery->where('new', 1);
        }
        if ($request->filled('recommend')) {
            $productsQuery->where('recommend', 1);
        }
        if ($request->filled('text_search')) {
            $productsQuery->where('name', 'LIKE', "%{$request->text_search}%");
        }

        // dd($request->getQueryString());
        // $products = $productsQuery->paginate(6);
        $products = $productsQuery->where('is_active', 1)->paginate(6);
        return view('index', compact('products', 'usd', 'eur', 'rub'));
    }
    public function categories()
    {
        $categories = Category::get(); // возврат коллекции
        return view('categories', compact('categories'));
    }
    public function category($code)
    {

        $client = new \GuzzleHttp\Client();
        $currencyRequest = $client->request('GET', 'https://api.nbrb.by/exrates/rates?periodicity=0&parammode=19');
        $currencyResponse = json_decode($currencyRequest->getBody()->getContents());
        $usd = $currencyResponse[7]->Cur_OfficialRate;
        $eur = $currencyResponse[9]->Cur_OfficialRate;
        $rub = $currencyResponse[21]->Cur_OfficialRate;

        $category = Category::where('code', $code)->first(); // возвращает объект (поиск по элементу code и возврат объекта category)
        // $products = Product::where('category_id', $category->id)->get(); // удалено из-за вызова hasMany в модели
        return view('category', compact('category', 'usd', 'eur', 'rub')); // , 'products' - удалено
    }
    public function product($categoryCheck, $productCheck = null) //дефолтное значение
    {
        $client = new \GuzzleHttp\Client();
        $currencyRequest = $client->request('GET', 'https://api.nbrb.by/exrates/rates?periodicity=0&parammode=19');
        $currencyResponse = json_decode($currencyRequest->getBody()->getContents());
        $usd = $currencyResponse[7]->Cur_OfficialRate;
        $eur = $currencyResponse[9]->Cur_OfficialRate;
        $rub = $currencyResponse[21]->Cur_OfficialRate;

        $product = Product::where('code', $productCheck)->first();
        $images = Imag::where('product_id', $product->id)->get();
        $category = Category::where('id', $product->category_id)->first();

        $comments = $product->reviews;



        return view('product', compact('category', 'product', 'usd', 'eur', 'rub', 'images', 'comments'));
    }
}
