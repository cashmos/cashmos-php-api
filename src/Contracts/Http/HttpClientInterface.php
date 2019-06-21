<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:06 AM
 */

namespace Cashmos\Contracts\Http;


/**
 * Interface HttpClientInterface
 * @package Cashmos2\Contracts\Http
 */
interface HttpClientInterface
{
    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $body
     * @param array $queryParams
     * @param array $headers
     * @return mixed
     */
    public function post($baseUrl, $resourcePath = '', $body = [], $queryParams = [], $headers = []);

    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $body
     * @param array $queryParams
     * @param array $headers
     * @return mixed
     */
    public function patch($baseUrl, $resourcePath = '', $body = [], $queryParams = [], $headers = []);

    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $body
     * @param array $queryParams
     * @param array $headers
     * @return mixed
     */
    public function put($baseUrl, $resourcePath = '', $body = [], $queryParams = [], $headers = []);

    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $queryParams
     * @param array $headers
     * @return mixed
     */
    public function get($baseUrl, $resourcePath = '', $queryParams = [], $headers = []);

    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $queryParams
     * @param array $headers
     * @return mixed
     */
    public function delete($baseUrl, $resourcePath = '', $queryParams = [], $headers = []);
}