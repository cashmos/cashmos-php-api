<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 1:15 PM
 */

namespace Tests;


use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Services\Billing\Billing;
use Cashmos\Services\Billing\BillPayment;
use PHPUnit\Framework\TestCase;

class BillingTest extends TestCase
{

    public function test_it_can_create_billing_token(){

        $amount = 45;
        $profileId = '@fako';
        $billing = new Billing($amount, $profileId);

        $randomToken = 'some-random-billing-token';

        $httpClient = \Mockery::mock(HttpClientInterface::class);
        $httpClient->shouldReceive('post')
            ->with('billing', 'token', [
                'amount' => $amount,
                'recipient_profile_id' => $profileId,
                'description' => null
            ])
            ->andReturn(['token' => $randomToken]);

        $token = $billing->process($httpClient);
        $this->assertTrue(!empty($token));
        $this->assertEquals($randomToken, $token);

    }

    public function test_it_can_claim_payment(){

        $amount = 45;
        $profileId = '@fako';
        $billing = new Billing($amount, $profileId);

        $randomToken = 'some-random-billing-token';

        $httpClient = \Mockery::mock(HttpClientInterface::class);
        $httpClient->shouldReceive('post')
            ->with('billing', null, ['token' => $randomToken])
            ->andReturn(true);

        $payment = new BillPayment($randomToken);
        $this->assertTrue($payment->process($httpClient));

    }
}
