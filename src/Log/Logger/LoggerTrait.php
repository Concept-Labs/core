<?php
namespace Cl\Log\Logger;

use Cl\Log\Logger\LogLevelEnum;
use Cl\Psr\InvalidArgumentException;


trait LoggerTrait
{
    /**
     * @inheritdoc
     */
    public function emergency($message, array $context = []): void
    {
        $this->log(LogLevelEnum::EMERGENCY, $message, $context);
    }
    
    /**
     * @inheritdoc
     */
    public function alert($message, array $context = []): void
    {
        $this->log(LogLevelEnum::ALERT, $message, $context);
    }
    
    /**
     * @inheritdoc
     */
    public function critical($message, array $context = []): void
    {
        $this->log(LogLevelEnum::CRITICAL, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function error($message, array $context = []): void
    {
        $this->log(LogLevelEnum::ERROR, $message, $context);
    }
    
    /**
     * @inheritdoc
     */
    public function warning($message, array $context = []): void
    {
        $this->log(LogLevelEnum::WARNING, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function notice($message, array $context = []): void
    {
        $this->log(LogLevelEnum::NOTICE, $message, $context);
    }
    
    /**
     * @inheritdoc
     */
    public function info($message, array $context = []): void
    {
        $this->log(LogLevelEnum::INFO, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function debug($message, array $context = []): void
    {
        $this->log(LogLevelEnum::DEBUG, $message, $context);
    }
     
    /**
     * @inheritdoc
     */
    public function log($level, $message, ?array $context = []): void
    {
        $message = "".$this->interpolate($message, $context);
        match ($level) {
            LogLevelEnum::EMERGENCY, LogLevelEnum::ALERT, LogLevelEnum::CRITICAL => $this->notify($message),
            default => throw new InvalidArgumentException(sprintf('Invalid Log level: "%s"'))
        };
        echo $message;
    }
}