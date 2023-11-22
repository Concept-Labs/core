<?php
namespace Cl\Core\Log\Logger;

interface LoggerNotifyInterface
{
    public function notify(string $message) : void;
}