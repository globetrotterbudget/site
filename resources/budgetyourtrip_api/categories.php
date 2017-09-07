<?php

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