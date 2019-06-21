<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 12:53 PM
 */

namespace Cashmos\Contracts\Services\Billing;


/**
 * Interface BillingInterface
 * @package Cashmos\Contracts\Services\Billing
 */
interface BillingInterface
{

    /**
     * @return float
     */
    public function getAmount();

    /**
     * @return string
     */
    public function getRecipientProfileId();

    /**
     * @return string
     */
    public function getDescription();

}