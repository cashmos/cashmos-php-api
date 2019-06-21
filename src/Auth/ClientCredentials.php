<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:13 AM
 */

namespace Cashmos\Auth;


use Cashmos\Contracts\Auth\ClientCredentialsAuthInterface;

/**
 * Class ClientCredentials
 * @package Cashmos2\Auth
 */
class ClientCredentials implements ClientCredentialsAuthInterface
{

    /**
     * @var
     */
    private $clientId;
    /**
     * @var
     */
    private $clientSecret;

    /**
     * ClientCredentials constructor.
     * @param $clientId
     * @param $clientSecret
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     *
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }


    /**
     * @return array
     */
    public function getAuthHeader()
    {
        return [
            'client-id' => $this->getClientId(),
            'secret' => $this->getClientSecret()
        ];
    }


}