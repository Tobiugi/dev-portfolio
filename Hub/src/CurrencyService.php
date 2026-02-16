<?php
namespace App;

class CurrencyService {
    public function getEurRate() {
        $response = file_get_contents('https://api.nbp.pl/api/exchangerates/rates/a/eur/?format=json');
        $data = json_decode($response, true);
        return $data['rates'][0]['mid'];
    }
}