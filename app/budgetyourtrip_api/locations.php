<?php
namespace App\Budgetyourtrip_api;
use App\budgetyourtrip_api\lib\bytapiconnection;

class Locations extends BYTAPIConnection
{
    function getLocation($geonameid)
    {
        return $this->makeRequest("/locations/".$geonameid);
    }

    function search($name)
    {
        return $this->makeRequest("/search/location/".$name);
    }

    function searchdata($name)
    {
        return $this->makeRequest("/search/locationdata/".$name);
    }

    function geo($lat, $lng)
    {
        return $this->makeRequest("/search/geo/".$lat."/".$lng);
    }

    function geodata($lat, $lng)
    {
        return $this->makeRequest("/search/geodata/".$lat."/".$lng);
    }
}