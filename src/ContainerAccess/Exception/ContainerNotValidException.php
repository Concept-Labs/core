<?php

namespace Cl\ContainerAccess\Exception;

class ContainerNotValidException extends \Exception
{
    public function __construct($message)
    {
        $message = "{$message}";
        parent::__construct($message);
    }
}