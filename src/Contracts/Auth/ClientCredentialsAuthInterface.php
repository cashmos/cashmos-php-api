<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:08 AM
 */

namespace Cashmos\Contracts\Auth;


/**
 * Interface ClientCredentialsAuthInterface
 * @package Cashmos2\Contracts\Auth
 */
interface ClientCredentialsAuthInterface extends AuthInterface
{

    /**
     * Gets the client id
     *
     * @return string
     */
    public function getClientId();

    /**
     * Gets the client secret
     *
     * @return string
     */
    public function getClientSecret();

}