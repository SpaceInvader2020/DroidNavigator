<?php
namespace App;

class Client
{

    public function getResponse($url){
        $connection = curl_init();

        curl_setopt($connection, CURLOPT_URL, $url);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        $jsonResponse = curl_exec($connection);
        curl_close($connection);
        $response = json_decode($jsonResponse, true);
        return $response;
    }
}