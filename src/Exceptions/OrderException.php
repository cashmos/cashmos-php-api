<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 6/18/17
 * Time: 1:48 AM
 */

namespace Cashmos\Exceptions;


use Throwable;

class OrderException extends \Exception
{

    public function __construct($message)
    {
        parent::__construct('Error with order: '.$message);
    }

}