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
     * The order processor
     *
     * @var OrderProcessor
     */
    private $processor;

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
        $this->processor = new OrderProcessor($client);
        return $this->processor->confirmOrder($this->token);
    }

    /**
     * Gets custom data associated with the order
     *
     * @return array
     */
    public function getCustomData(){
        if(!$this->processor) // Confirmation has not been processed yet.
            throw new ProcessException('You need to confirm the payment first.');

        return $this->processor->getCustomData($this->token);
    }

}