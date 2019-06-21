<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:46 AM
 */

namespace Cashmos\Services;

use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Http\HttpClient;

/**
 * Class Processor
 * @package Cashmos\Services
 */
abstract class Processor
{

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * Processor constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }

}