<?php
namespace Cl\Log\Logger;

trait LoggerNotifyTrait 
{
    protected $notifier;
    public function notify(string $message) : void
    {
        echo 'NOTIFY: '.$message;
        //@TODO
    }
}