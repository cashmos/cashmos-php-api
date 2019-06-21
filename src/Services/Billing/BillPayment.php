<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 1:11 PM
 */

namespace Cashmos\Services\Billing;


use Cashmos\Contracts\Auth\AuthInterface;
use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Contracts\Services\Processable;
use Cashmos\Exceptions\ProcessException;

/**
 * Class BillPayment
 * @package Cashmos\Services\Billing
 */
class BillPayment implements Processable
{

    /**
     * @var string
     */
    protected $token;


    /**
     * BillPayment constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @param HttpClientInterface $client
     * @return bool
     */
    public function process(HttpClientInterface $client)
    {
        return (new BillingProcessor($client))->claimPayment($this->token);
    }


}