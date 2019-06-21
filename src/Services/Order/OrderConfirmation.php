<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 12:50 PM
 */

namespace Cashmos\Services\Order;


use Cashmos\Contracts\Auth\AuthInterface;
use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Contracts\Services\Processable;
use Cashmos\Exceptions\ProcessException;
use Cashmos\Http\HttpClient;

/**
 * Class OrderConfirmation
 * @package Cashmos\Services\Order
 */
class OrderConfirmation implements Processable
{

    /**
     * @var string
     */
    protected $token;

    /**
     * OrderConfirmation constructor.
     * @param $token
     */
    public function __construct($token){
        $this->token = $token;
    }

    /**
     * @param HttpClientInterface $client
     * @return bool
     */
    public function process(HttpClientInterface $client)
    {
        return (new OrderProcessor($client))->confirmOrder($this->token);
    }


}