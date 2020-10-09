<?php
namespace EmpireCli;

use App\Client;
use App\PathFinder;
error_reporting(E_ALL);

class App
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $baseUrl;
    /**
     * @var PathFinder
     */
    private $pathFinder;


    /**
     * @param array $argv
     * @param array $config
     */
    public function runCommand(array $argv, array $config)
    {


        $this->client = new Client();
        $this->pathFinder = new PathFinder();
        $this->baseUrl = $config["url"];

        if (isset($argv[1])) {
            $this->pathFinder->setPath($argv[1]);
        }

        $response["message"] = '';

        while( !strstr($response["message"],'Destination reached.')) {

            $this->pathFinder->stepForward();

            $url = $this->baseUrl . $this->pathFinder->getPath();
            $response = $this->client->getResponse($url);

            if( strstr($response["message"] ,"Crashed") ){

                $this->pathFinder->stepBack();
                $this->pathFinder->stepLeftOrRight();

                $response = $this->client->getResponse($this->baseUrl . $this->pathFinder->getPath());

                if( strstr($response["message"] ,"Crashed") ){
                    $this->pathFinder->clearPreviousMovingDirection();
                    $response = $this->client->getResponse($this->baseUrl . $this->pathFinder->getPath());
                }

            }
        }
        echo $this->pathFinder->getPath();
    }
}