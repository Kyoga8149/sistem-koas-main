<?php

namespace App\Exceptions;

use Exception;

class InvalidStatusException extends Exception
{
    public function __construct($message = "Invalid Status", $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
