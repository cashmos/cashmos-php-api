<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/17/17
 * Time: 11:07 PM
 */

namespace Cashmos\Contracts\Services\Order;


/**
 * Interface Tax
 * @package Cashmos2\Order\Contracts
 */
interface Tax
{

    /**
     * @return mixed
     */
    public function name();

    /**
     * @return mixed
     */
    public function amount();

}