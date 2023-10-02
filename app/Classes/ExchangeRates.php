<?php

namespace App\Classes;



class ExchangeRates
{

    public function  takeRates()
    {
        $client = new \GuzzleHttp\Client();
        $currencyRequest = $client->request('GET', 'https://api.nbrb.by/exrates/rates?periodicity=0&parammode=19');
        $currencyResponse = json_decode($currencyRequest->getBody()->getContents());
        // eur - 9 / usd -7 / rub - 21
        $usd = $currencyResponse[7]->Cur_OfficialRate;
        $eur = $currencyResponse[9]->Cur_OfficialRate;
        $rub = $currencyResponse[21]->Cur_OfficialRate;
        $AllRates = ['USD' => $usd, 'EUR' => $eur, 'RUB' => $rub];
        return $AllRates;
    }
}
