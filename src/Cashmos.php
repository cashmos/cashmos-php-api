<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:19 AM
 */

namespace Cashmos;


use Cashmos\Auth\ClientCredentials;
use Cashmos\Contracts\Auth\AuthInterface;
use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Contracts\Services\Processable;
use Cashmos\Exceptions\ProcessException;
use Cashmos\Http\HttpClient;

/**
 * Class Cashmos
 * @package Cashmos
 */
class Cashmos
{

    /**
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $error;

    /**
     * Cashmos constructor.
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->setHttpClient(new ClientCredentials($clientId, $clientSecret));
    }

    /**
     * @param Processable $processable
     * @return mixed
     */
    public function process(Processable $processable){

        try{
            return $processable->process($this->client);
        }catch (ProcessException $e){
            $this->error = $e->getMessage();
            return false;
        }

    }


    /**
     * @return string
     */
    public function getError(){
        return $this->error;
    }


    /**
     * @return bool
     */
    public function hasError(){
        return !is_null($this->getError());
    }


    /**
     * @param AuthInterface $auth
     */
    private function setHttpClient(AuthInterface $auth){
        $this->client = new HttpClient($auth);
    }

}