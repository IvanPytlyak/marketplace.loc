<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Imag;
use GuzzleHttp\Client;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use Laravel\Ui\Presets\React;
use App\Classes\ExchangeRates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\ProductsFilterRequest;
use App\Models\Currency;

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
        // eur - 9 / usd -7 / rub - 21

        // 33-39 рабочий вариант (сильно нагружает страницу, постоянно обращается к внешнему ресурсу)
        // $client = new \GuzzleHttp\Client();
        // $currencyRequest = $client->request('GET', 'https://api.nbrb.by/exrates/rates?periodicity=0&parammode=19');
        // $currencyResponse = json_decode($currencyRequest->getBody()->getContents());

        // $usd = $currencyResponse[7]->Cur_OfficialRate;
        // $eur = $currencyResponse[9]->Cur_OfficialRate;
        // $rub = $currencyResponse[21]->Cur_OfficialRate;


        $AllRates = new ExchangeRates();
        $usd = $AllRates->takeRates()['USD'];
        $eur = $AllRates->takeRates()['EUR'];
        $rub = $AllRates->takeRates()['RUB'];


        $currentDate = Carbon::now()->toDateString();
        $existingRecords = DB::table('currencies')->whereDate('date', $currentDate)->count();

        if ($existingRecords === 0) {
            DB::table('currencies')->insert([

                [
                    'code' => 'BYN',
                    'symbol' => 'BYN',
                    'is_main' => '1',
                    'rate' => '1',
                    'date' => $currentDate
                ],
                [
                    'code' => 'EUR',
                    'symbol' => '€',
                    'is_main' => '0',
                    'rate' => $eur,
                    'date' => $currentDate
                ],
                [
                    'code' => 'USD',
                    'symbol' => '$',
                    'is_main' => '0',
                    'rate' => $usd,
                    'date' => $currentDate
                ]
            ]);

            DB::table('datestatuses')->insert(
                [
                    'daily_record_status' => $currentDate,
                    'records_added' => 1
                ]
            );
        }


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

        if (!session()->has('currencies')) {
            $currencies =  Currency::where('date', Carbon::now()->toDateString())->get();
            session(['currencies' => $currencies]);
        }


        return view('index', compact('products', 'usd', 'eur', 'rub'));
    }





    public function categories()
    {
        $categories = Category::get(); // возврат коллекции
        return view('categories', compact('categories'));
    }






    public function category($code)
    {

        // $client = new \GuzzleHttp\Client();
        // $currencyRequest = $client->request('GET', 'https://api.nbrb.by/exrates/rates?periodicity=0&parammode=19');
        // $currencyResponse = json_decode($currencyRequest->getBody()->getContents());
        // $usd = $currencyResponse[7]->Cur_OfficialRate;
        // $eur = $currencyResponse[9]->Cur_OfficialRate;
        // $rub = $currencyResponse[21]->Cur_OfficialRate;


        $AllRates = new ExchangeRates();
        $usd = $AllRates->takeRates()['USD'];
        $eur = $AllRates->takeRates()['EUR'];
        $rub = $AllRates->takeRates()['RUB'];



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
        // $product = Product::where('code', $productCheck)->firstOrFail();
        $images = Imag::where('product_id', $product->id)->get();
        $category = Category::where('id', $product->category_id)->first();

        $comments = $product->reviews;



        return view('product', compact('category', 'product', 'usd', 'eur', 'rub', 'images', 'comments'));
    }


    public function subscribe(SubscriptionRequest $request, Product $product)
    {
        Subscription::create(
            [
                'email' => $request->email,
                'product_id' => $product->id,
            ]
        );

        return redirect()->back()->with('success', 'Спасибо, мы свяжимся с Вами после появления товара на складе');
    }


    public function changeLocale($locale)
    {
        $availableLocales = ['ru', 'en'];
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        // $currentLocale = App::getLocale();
        return redirect()->back();
    }

    public function changeCurrency($currencyCode)
    {
        $currencyDate = Carbon::now()->toDateString();
        $currency = Currency::ByCode($currencyCode, $currencyDate)->firstOrFail();
        $currencies =  Currency::where('date', $currencyDate)->get();

        session([
            'currency' => $currency->code,
            'currencyRate' => $currency->rate,
            'currencyDate' => $currencyDate,
            'currencies' => $currencies
        ]);
        return redirect()->back();
    }

    public function clearCurrencySession()
    {
        session()->forget('currency');
        session()->forget('currencyDate');
        session()->forget('currencies');
        session()->forget('currencyRate');
    }
}
