<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/18/17
 * Time: 1:35 AM
 */

namespace Cashmos\Services\Order;

use Cashmos\Contracts\Services\Order\Item as ItemInterface;

/**
 * Class Item
 * @package Cashmos2\Order
 */
class Item implements ItemInterface
{

    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $description;

    /**
     * @var null
     */
    private $sku;

    /**
     * @var
     */
    private $unitPrice;

    /**
     * @var string
     */
    private $category;

    /**
     * @var
     */
    private $quantity;

    /**
     * Item constructor.
     * @param $name
     * @param $unitPrice
     * @param $quantity
     * @param $description
     * @param string $category
     * @param null $sku
     */
    public function __construct($name, $unitPrice, $quantity, $description, $category = '', $sku = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->unitPrice = $unitPrice;
        $this->sku = $sku;
        $this->category = $category;
        $this->quantity = $quantity;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name(),
            'description' => $this->description(),
            'sku' => $this->sku(),
            'category' => $this->category(),
            'unit_price' => $this->unitPrice(),
            'quantity' => $this->quantity()
        ];
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
    public function description()
    {
        return $this->description;
    }

    /**
     * @return null
     */
    public function sku()
    {
        return $this->sku;
    }

    /**
     * @return float
     */
    public function unitPrice()
    {
        return round($this->unitPrice, 2);
    }

    /**
     * @return mixed
     */
    public function quantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function category()
    {
        return $this->category;
    }


}