<?php

namespace Tests;


use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Services\Billing\Billing;
use Cashmos\Services\Billing\BillPayment;
use PHPUnit\Framework\TestCase;
use Mockery;
use Cashmos\Services\Order\OrderConfirmation;

class OrderConfirmationTest extends TestCase{

    public function test_it_can_confirm_order(){

        $customData = [
            'foo' => 'bar',
            'baz' => 'baad'
        ];

        $httpClient = Mockery::mock(HttpClientInterface::class);
        $httpClient->shouldReceive('post')->once()->andReturnNull();
        $httpClient->shouldReceive('get')->once()->andReturn($customData);

        $token = 'some-random-order-token';

        $confirmation = new OrderConfirmation($token);
        
        // First process the confirmation
        $confirmation->process($httpClient);

        // Get custom data
        $this->assertEquals(
            $customData,
            $confirmation->getCustomData()
        );

    }

}