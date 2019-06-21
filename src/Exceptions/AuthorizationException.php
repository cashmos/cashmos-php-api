<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/18/17
 * Time: 1:04 AM
 */

namespace Cashmos\Exceptions;


use Throwable;

class AuthorizationException extends \Exception
{

    public function __construct($message)
    {
        parent::__construct('Authorization Error: '. $message);
    }

}