<?php
namespace Cl\Log\Logger;

interface LoggerNotifyInterface
{
    public function notify(string $message) : void;
}