<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/17/17
 * Time: 11:04 PM
 */

namespace Cashmos\Services\Order;

use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Contracts\Services\Order\Item as ItemInterface;
use Cashmos\Contracts\Services\Order\Order as OrderInterface;
use Cashmos\Contracts\Services\Order\Tax as TaxInterface;
use Cashmos\Contracts\Services\Processable;
use Cashmos\Exceptions\OrderException;
use Illuminate\Support\Collection;

/**
 * Class Order
 * @package Cashmos\Services\Order
 */
final class Order implements OrderInterface, Processable
{

    /**
     * @var Collection
     */
    private $items;


    /**
     * @var array
     */
    private $metadata = [];


    /**
     * @var Collection
     */
    private $taxes;


    /**
     * @var float
     */
    private $orderTotal = 0.0;


    /**
     * Indicates whether order total has been set.
     *
     * @var bool
     */
    private $orderTotalSet = false;


    /**
     * @var string
     */
    private $returnUrl;


    /**
     * @var string
     */
    private $cancelUrl;


    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->items = new Collection;
        $this->taxes = new Collection;
    }


    /**
     * @param ItemInterface $item
     * @return \Cashmos\Contracts\Services\Order\Order
     */
    public function addItem(ItemInterface $item)
    {
        $this->items->push($item);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * @param $total
     * @return $this
     */
    public function setOrderTotal($total)
    {
        $this->orderTotal = $total;
        $this->orderTotalSet = true;
        return $this;
    }


    /**
     * @return float
     */
    public function getOrderTotal()
    {
        return round($this->orderTotal, 2);
    }


    /**
     * @param $name
     * @param $amount
     * @return \Cashmos\Contracts\Services\Order\Order
     */
    public function addTax($name, $amount)
    {
        $this->taxes->push(new Tax($name, $amount));
        return $this;
    }


    /**
     * @param array $data
     * @return $this
     */
    public function addCustomData(array $data)
    {
        $this->metadata = $data;
        return $this;
    }


    /**
     * @return array
     */
    public function getCustomData()
    {
        return $this->metadata;
    }


    /**
     * @return Collection
     */
    protected function getTaxes(){
        return $this->taxes;
    }


    /**
     * @param $url
     * @return Order
     */
    public function returnUrl($url){
        $this->returnUrl = $url;
        return $this;
    }


    /**
     * @param $url
     * @return Order
     */
    public function cancelUrl($url){
        $this->cancelUrl = $url;
        return $this;
    }



    /**
     * @return array
     * @throws OrderException
     */
    public function toArray()
    {

        if(!$this->orderTotalSet || $this->orderTotal <= 0)
            throw new OrderException('Order total must be set and greater than zero.');

        $items = [];
        $taxes = [];

        $this->getItems()->each(function(ItemInterface $item) use (&$items){
            $items[] = $item->toArray();
        });

        $this->getTaxes()->each(function(TaxInterface $tax) use (&$taxes){
            $taxes[] = [
                'name' => $tax->name(),
                'amount' => $tax->amount()
            ];
        });

        return [
            'items' => $items,
            'taxes' => $taxes,
            'custom_data' => $this->getCustomData(),
            'amount' => $this->getOrderTotal(),
            'return_url' => $this->returnUrl,
            'cancel_url' => $this->cancelUrl
        ];
    }


    /**
     * @param HttpClientInterface $client
     * @return mixed
     */
    public function process(HttpClientInterface $client)
    {
        return (new OrderProcessor($client))->placeOrder($this);
    }

}