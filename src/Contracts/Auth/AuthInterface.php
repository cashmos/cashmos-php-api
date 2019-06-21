<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 12/13/17
 * Time: 11:15 AM
 */

namespace Cashmos\Contracts\Auth;


/**
 * Interface AuthInterface
 * @package Cashmos2\Contracts\Auth
 */
interface AuthInterface
{

    /**
     * Gets the authentication header info
     *
     * @return array
     */
    public function getAuthHeader();

}