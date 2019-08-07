<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:41 AM
 */

namespace Cashmos\Services\Order;

use Cashmos\Contracts\Services\Order\Order;
use Cashmos\Exceptions\ProcessException;
use Cashmos\Services\Processor;

/**
 * Class OrderProcessor
 * @package Cashmos\Services\Order
 */
class OrderProcessor extends Processor
{

    /**
     * @param Order $order
     * @throws ProcessException
     */
    public function placeOrder(Order $order){
        // Post order data to server
        try{
            $response =  $this->httpClient->post('orders', null,
                $order->toArray());

            // Redirect to Cashmos checkout page
            header('Location: '.$response['invoice_url']);
            exit;
        }catch (\Exception $e){
            throw new ProcessException($e->getMessage());
        }
    }


    /**
     * @param $token
     * @return bool
     * @throws ProcessException
     */
    public function confirmOrder($token){
        try{
            $this->httpClient->post('orders/', $token.'/payments');
            return true;
        }catch (\Exception $e){
            throw new ProcessException($e->getMessage());
        }
    }


    /**
     * Gets custom data associated with an order
     *
     * @param string $token
     * @return void
     */
    public function getCustomData($token){
        try{

            return $this->httpClient->get('orders/', $token . '/custom-data');
        }catch(\Exception $e){
            throw new ProcessException($e->getMessage());
        }
    }

}