<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 12:58 PM
 */

namespace Cashmos\Services\Billing;


use Cashmos\Contracts\Auth\AuthInterface;
use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Contracts\Services\Billing\BillingInterface;
use Cashmos\Contracts\Services\Processable;
use Cashmos\Exceptions\ProcessException;

/**
 * Class Billing
 * @package Cashmos\Services\Billing
 */
class Billing implements BillingInterface, Processable
{

    /**
     * @var float
     */
    protected $amount;
    /**
     * @var string
     */
    protected $recipientProfileId;
    /**
     * @var string
     */
    protected $description;


    /**
     * Billing constructor.
     * @param null $amount
     * @param null $recipientProfileId
     * @param null $description
     */
    public function __construct($amount = null, $recipientProfileId = null, $description = null)
    {
        $this->setAmount($amount);
        $this->setRecipientProfileId($recipientProfileId);
        $this->setDescription($description);
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getRecipientProfileId()
    {
        return $this->recipientProfileId;
    }

    /**
     * @param mixed $recipientProfileId
     */
    public function setRecipientProfileId($recipientProfileId)
    {
        $this->recipientProfileId = $recipientProfileId;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @param HttpClientInterface $client
     * @return mixed
     */
    public function process(HttpClientInterface $client)
    {
        return (new BillingProcessor($client))->requestToken($this);
    }


}