<?php
namespace EmpireCli;
use App\Client;
use App\PathFinder;

class App
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var PathFinder
     */
    private $pathFinder;


    /**
     * @param array $config
     */
    public function runCommand(array $config)
    {


        $this->client = new Client();
        $this->pathFinder = new PathFinder();

        $response["message"] = '';

        while( !strstr($response["message"],'Destination reached.')) {

            $this->pathFinder->stepForward();

            $url = $config["base_url"] . $this->pathFinder->getPath();
            $response = $this->client->getResponse($url);

            if( strstr($response["message"] ,"Crashed") ){

                $this->pathFinder->stepBack();
                $this->pathFinder->stepLeftOrRight();

                $response = $this->client->getResponse($config["base_url"] . $this->pathFinder->getPath());

                if( strstr($response["message"] ,"Crashed") ){
                    $this->pathFinder->clearPreviousMovingDirection();
                    $response = $this->client->getResponse($config["base_url"] . $this->pathFinder->getPath());
                }

            }
        }
        echo $this->pathFinder->getPath();
    }
}