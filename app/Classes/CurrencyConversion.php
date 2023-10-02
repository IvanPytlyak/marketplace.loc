<?php

namespace App\Classes;

use Carbon\Carbon;
use App\Models\Currency;

class CurrencyConversion
{
    protected static $container;

    public static function loadContainer()
    {
        if (is_null(self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
                self::$container[$currency->date] = Carbon::now()->toDateString();
            }
        }
    }

    public static function getCurrencies()
    {
        return self::$container; // ТУТ {{-- @dd(App\Models\Currency::where('date', \Carbon\Carbon::now()->toDateString())->get()); --}} master  42
    }

    public static function convert($sum, $originCurrencyCode = 'BYN', $targetCurrencyCode = null)
    {
        self::loadContainer();

        // $originCurrency = Currency::ByCode($originCurrencyCode, Carbon::now()->toDateString())->first();
        $originCurrency = self::$container[$originCurrencyCode];

        if (is_null($targetCurrencyCode)) {
            $targetCurrencyCode = session('currency', 'BYN');
        }
        $targetCurrency = self::$container[$targetCurrencyCode];
        // $targetCurrency = Currency::ByCode($targetCurrencyCode, Carbon::now()->toDateString())->first();
        return $sum / $targetCurrency->rate * $originCurrency->rate;
    }


    public static function getCurrencySymbol()
    {
        self::loadContainer();

        // $currency = Currency::ByCode(session('currency', 'BYN'), Carbon::now()->toDateString())->first();
        $currencyFromSession = session('currency', 'BYN');
        $currency =  self::$container[$currencyFromSession];

        return $currency->symbol;
    }
}
