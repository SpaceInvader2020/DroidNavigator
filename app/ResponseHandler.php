<?php


namespace App;


class ResponseHandler
{
    public static function handle($response){
        if( strstr( $response["message"],'Destination reached') ) {
            return true;
        }else {
            return false;
        }
   }
}