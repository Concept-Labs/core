<?php
namespace Cl\Log\Logger;

/**
 * Describes a logger-aware instance.
 */
trait LoggerAwareTrait
{
    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     * @return void
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}