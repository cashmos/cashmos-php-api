<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:11 AM
 */

namespace Cashmos\Contracts\Services;


use Cashmos\Contracts\Auth\AuthInterface;
use Cashmos\Contracts\Http\HttpClientInterface;
use Cashmos\Exceptions\ProcessException;
use Cashmos\Http\HttpClient;

/**
 * Interface Processable
 * @package Cashmos2\Contracts\Services
 */
interface Processable
{

    /**
     * @param HttpClientInterface $client
     * @return mixed
     * @throws ProcessException
     */
    public function process(HttpClientInterface $client);

}