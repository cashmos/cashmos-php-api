<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:28 AM
 */

namespace Cashmos\Http;

use Cashmos\Contracts\Auth\AuthInterface;
use Cashmos\Contracts\Http\HttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpClient
 * @package Cashmos\Http
 */
class HttpClient implements HttpClientInterface
{

    const HOST_URL = 'https://cashmos.herokuapp.com/api/v1/';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;


    /**
     * HttpClient constructor.
     * @param AuthInterface $auth
     */
    public function __construct(AuthInterface $auth)
    {
        $this->httpClient = new Client([
            'base_uri' => static::HOST_URL,
            'headers' => array_merge([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ], $auth->getAuthHeader())
        ]);
    }


    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $body
     * @param array $queryParams
     * @param array $headers
     * @return array
     */
    public function post($baseUrl, $resourcePath = '', $body = [], $queryParams = [], $headers = []){
        return $this->parseResponse($this->httpClient->post($this->getUrl($baseUrl, $resourcePath), [
            'headers' => $headers,
            'json' => $body,
            'query' => $queryParams
        ]));
    }


    /**
     * @param ResponseInterface $response
     * @return array
     */
    protected function parseResponse(ResponseInterface $response){
        return json_decode((string) $response->getBody(), true);
    }


    /**
     * @param $baseUrl
     * @param $resourcePath
     * @param array $queryParams
     * @param array $headers
     * @return array
     * @throws RequestException
     * @throws ClientException
     */
    public function get($baseUrl, $resourcePath = '', $queryParams = [], $headers = []){
        return $this->parseResponse($this->httpClient->get($this->getUrl($baseUrl, $resourcePath), [
            'headers' => $headers,
            'query' => $queryParams
        ]));
    }


    /**
     * @param $baseUrl
     * @param null $resourcePath
     * @return string
     */
    private function getUrl($baseUrl, $resourcePath = null){
        $resourcePath = ($resourcePath) ?: '/';
        return rtrim(static::HOST_URL.trim($baseUrl,'/').'/'.ltrim($resourcePath, '/'), '/');
    }


    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $queryParams
     * @param array $headers
     * @return array
     */
    public function delete($baseUrl, $resourcePath = '', $queryParams = [], $headers = [])
    {
        return $this->parseResponse($this->httpClient->delete($this->getUrl($baseUrl, $resourcePath), [
            'headers' => $headers,
            'query' => $queryParams
        ]));
    }

    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $body
     * @param array $queryParams
     * @param array $headers
     * @return array
     */
    public function patch($baseUrl, $resourcePath = '', $body = [], $queryParams = [], $headers = [])
    {
        return $this->parseResponse($this->httpClient->patch($this->getUrl($baseUrl, $resourcePath), [
            'headers' => $headers,
            'json' => $body,
            'query' => $queryParams
        ]));
    }

    /**
     * @param $baseUrl
     * @param string $resourcePath
     * @param array $body
     * @param array $queryParams
     * @param array $headers
     * @return array
     */
    public function put($baseUrl, $resourcePath = '', $body = [], $queryParams = [], $headers = [])
    {
        return $this->parseResponse($this->httpClient->put($this->getUrl($baseUrl, $resourcePath), [
            'headers' => $headers,
            'json' => $body,
            'query' => $queryParams
        ]));
    }


}