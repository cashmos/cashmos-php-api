<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/17/17
 * Time: 11:03 PM
 */

namespace Cashmos\Contracts\Services\Order;


use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface Item
 * @package Cashmos2\Order\Contracts
 */
interface Item extends Arrayable
{

    /**
     * @return mixed
     */
    public function name();

    /**
     * @return mixed
     */
    public function description();

    /**
     * @return mixed
     */
    public function sku();

    /**
     * @return mixed
     */
    public function unitPrice();

    /**
     * @return mixed
     */
    public function quantity();

    /**
     * @return mixed
     */
    public function category();

}