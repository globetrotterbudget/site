<?php
namespace App\budgetyourtrip_api;
use App\budgetyourtrip_api\lib\bytapiconnection;

class Categories extends BYTAPIConnection
{
    function getCategories($id = 0)
    {
        if($id > 0)
        {
            return $this->makeRequest("/categories/".$id);
        }
        return $this->makeRequest("/categories");
    }
}