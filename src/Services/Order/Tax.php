<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/17/17
 * Time: 11:08 PM
 */

namespace Cashmos\Services\Order;

use Cashmos\Contracts\Services\Order\Tax as TaxInterface;

/**
 * Class Tax
 * @package Cashmos2\Order
 */
class Tax implements TaxInterface
{

    /**
     * @var
     */
    protected $name;


    /**
     * @var
     */
    protected $amount;


    /**
     * Tax constructor.
     * @param $name
     * @param $amount
     */
    public function __construct($name, $amount)
    {
        $this->name = $name;
        $this->amount = round($amount, 2);
    }


    /**
     * @return mixed
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function amount()
    {
        return $this->amount;
    }

}