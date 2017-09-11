<?php
namespace App\budgetyourtrip_api;
use App\budgetyourtrip_api\lib\bytapiconnection;

class Currencies extends BYTAPIConnection
{
    function getCurrencies($currency_code = "")
    {
        if($currency_code != "")
        {
            return $this->makeRequest("/currencies/".$currency_code);
        }
        return $this->makeRequest("/currencies");
    }

    function convert($from, $to, $amount = 1)
    {
        return $this->makeRequest("/currencies/convert/".$from."/".$to."/".$amount);
    }

    function search($name)
    {
        return $this->makeRequest("/search/currency/".$name);
    }
}