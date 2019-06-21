<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/18/17
 * Time: 2:29 AM
 */

namespace Tests;

use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Services\Order\Item;
use Cashmos\Services\Order\Order;
use Cashmos\Services\Order\OrderConfirmation;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{

    public function test_it_can_create_order(){

        // Arrange
        $order = new Order();
        $order->addItem(new Item('Item 1', 34.887, 1, 'Item 1 desc', 'Category 1'));
        $order->addItem(new Item('Item 2', 12.67, 5, 'Item 2 desc', 'Category 2'));

        $meta = [
            'name' => 'Bright',
            'email' => 'brightantwiboasiako@aol.com'
        ];

        $order->addCustomData($meta);
        $total = 34.887 + 12.67 * 5;
        $order->setOrderTotal($total);


        // Assert
        $this->assertInstanceOf(Order::class, $order);
        $this->assertTrue(is_array($order->toArray()));
        $this->assertArrayHasKey('items', $order->toArray());
        $this->assertArrayHasKey('taxes', $order->toArray());
        $this->assertArrayHasKey('custom_data', $order->toArray());
        $this->assertArrayHasKey('amount', $order->toArray());
        $this->assertArrayHasKey('return_url', $order->toArray());
        $this->assertArrayHasKey('cancel_url', $order->toArray());

        $this->assertEquals($order->getCustomData(), $meta);
        $this->assertEquals($order->getOrderTotal(), round($total, 2));

    }

    /**
     * @runInSeparateProcess
     */
    public function test_it_can_process_order(){

        // Arrange
        $order = new Order();
        $order->addItem(new Item('Item 1', 34.887, 1, 'Item 1 desc', 'Category 1'));
        $order->addItem(new Item('Item 2', 12.67, 5, 'Item 2 desc', 'Category 2'));

        $meta = [
            'name' => 'Bright',
            'email' => 'brightantwiboasiako@aol.com'
        ];

        $order->addCustomData($meta);
        $total = 34.887 + 12.67 * 5;
        $order->setOrderTotal($total);

        // Mock
        $httpClient = \Mockery::mock(HttpClientInterface::class);
        $httpClient->shouldReceive('post')->with('orders', null, $order->toArray())->andReturn([
            'invoice_url' => 'https://example.com'
        ]);

        $order->process($httpClient);

        $this->assertEquals($order->getCustomData(), $meta);
        $this->assertEquals($order->getOrderTotal(), round($total, 2));

    }


    /**
     * @runInSeparateProcess
     */
    public function test_it_can_confirm_order_payment(){

        // Arrange
        $randomToken = 'some-random-payment-token';

        // Mock
        $httpClient = \Mockery::mock(HttpClientInterface::class);
        $httpClient->shouldReceive('post')->with('orders/', $randomToken . '/payments')->andReturnNull();

        $confirmation = new OrderConfirmation($randomToken);
        $this->assertTrue($confirmation->process($httpClient));

    }

}