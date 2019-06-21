<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/18/17
 * Time: 2:14 AM
 */

namespace Tests;

use Cashmos\Services\Order\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{

    public function testCanCreateItem(){

        $name = 'Item 1';
        $description = 'Item 1 desc';
        $price = 23.78;
        $sku = '4387hk3h4h';
        $category = 'Category 1';
        $quantity = 3;

        $item = new Item($name, $price, $quantity, $description, $category, $sku);

        $this->assertInstanceOf(Item::class, $item);
        $this->assertEquals($item->name(), $name);

    }

}