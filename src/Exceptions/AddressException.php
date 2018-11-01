<?php
namespace RuLong\Area\Exceptions;

use RuntimeException;

class AddressException extends RuntimeException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
