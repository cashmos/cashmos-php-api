<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/17/17
 * Time: 11:02 PM
 */

namespace Cashmos\Contracts\Services\Order;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Interface Order
 * @package Cashmos2\Order\Contracts
 */
interface Order extends Arrayable
{

    /**
     * @param Item $item
     * @return Order
     */
    public function addItem(Item $item);

    /**
     * @return Collection|array
     */
    public function getItems();


    /**
     * @param $total
     * @return mixed
     */
    public function setOrderTotal($total);


    /**
     * @return float
     */
    public function getOrderTotal();


    /**
     * @param $name
     * @param $amount
     * @return mixed
     */
    public function addTax($name, $amount);


    /**
     * Any other meta information added to the order
     *
     * @param array $data
     * @return mixed
     */
    public function addCustomData(array $data);


    /**
     * @param $url
     * @return Order
     */
    public function returnUrl($url);

    /**
     * @param $url
     * @return Order
     */
    public function cancelUrl($url);

}