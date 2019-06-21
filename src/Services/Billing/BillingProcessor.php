<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 12:59 PM
 */

namespace Cashmos\Services\Billing;


use Cashmos\Contracts\Services\Billing\BillingInterface;
use Cashmos\Exceptions\ProcessException;
use Cashmos\Services\Processor;

/**
 * Class BillingProcessor
 * @package Cashmos\Services\Billing
 */
class BillingProcessor extends Processor
{

    /**
     * @param BillingInterface $billing
     * @return mixed
     * @throws ProcessException
     */
    public function requestToken(BillingInterface $billing){

        // We send billing request to server

        try{
            $response = $this->httpClient->post('billing', 'token',[
                'amount' => $billing->getAmount(),
                'recipient_profile_id' => $billing->getRecipientProfileId(),
                'description' => $billing->getDescription()
            ]);

            return $response['token'];
        }catch (\Exception $e){
            throw new ProcessException($e->getMessage());
        }

    }


    /**
     * @param $token
     * @return bool
     * @throws ProcessException
     */
    public function claimPayment($token){

        // We send a request to server to process transaction
        try{
            $this->httpClient->post('billing', null,[
                'token' => $token
            ]);
            return true;
        }catch (\Exception $e){
            throw new ProcessException($e->getMessage());
        }

    }

}