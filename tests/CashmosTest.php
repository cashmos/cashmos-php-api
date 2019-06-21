<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/18/17
 * Time: 2:36 AM
 */

namespace Tests;


use Cashmos\Cashmos;
use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Contracts\Services\Processable;
use Cashmos\Services\Order\Order;
use Cashmos\Services\Order\Item;
use PHPUnit\Framework\TestCase;

class CashmosTest extends TestCase
{

    public function test_it_can_process_a_processable(){

        $httpClient = \Mockery::mock(HttpClientInterface::class);
        $httpClient->shouldReceive('post');

        $processable = \Mockery::mock(Processable::class);
        $processable->shouldReceive('process');

        $clientId = 'some-client-id';
        $secret = 'some-random-secret';

        $cashmos = new Cashmos($clientId, $secret);

        $cashmos->process($processable);

        $this->assertFalse($cashmos->hasError());
    }

}