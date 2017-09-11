<?php
namespace App\budgetyourtrip_api\lib;
use App\budgetyourtrip_api\lib\apiconnection;

abstract class BYTAPIConnection extends APIConnection
{

    function __construct($api_key)
    {
        parent::__construct();
        $this->API_KEY = $api_key;
        $this->HEADER_API_VARIABLE = "X-API-KEY";
        $this->BASE_API_URL = "http://www.budgetyourtrip.com/api/v3";
    }

}