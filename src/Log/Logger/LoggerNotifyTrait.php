<?php
namespace Cl\Core\Log\Logger;

trait LoggerNotifyTrait 
{
    protected $notifier;
    public function notify(string $message) : void
    {
        echo 'NOTIFY: '.$message;
        //@TODO
    }
}