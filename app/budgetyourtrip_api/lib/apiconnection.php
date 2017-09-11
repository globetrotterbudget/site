<?php
namespace App\budgetyourtrip_api\lib;
/*
 * A basic curl connection class
 */
abstract class APIConnection
{

    protected $BASE_API_URL;
    protected $API_KEY;
    protected $HEADER_API_VARIABLE;

    /**
     *
     */
    function __construct()
    {

    }

    /**
     * @param $endpoint
     */
    protected function makeRequest($endpoint)
    {
        $url = $this->BASE_API_URL . $endpoint;

        //  Initiate curl
        $ch = curl_init();

        // API Key Header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($this->HEADER_API_VARIABLE . ": ". $this->API_KEY ));

        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);

        // Execute
        $result=curl_exec($ch);

        // Closing curl object
        curl_close($ch);

        if(!$result)
        {
            //echo "result fail";
            return false;
        }

        $object = json_decode($result, false, 512);
        if($object->status == true)
        {
            //echo "got it!";
            return $object->data;
        }
        //echo "status is false";
        return false;
    }

}
