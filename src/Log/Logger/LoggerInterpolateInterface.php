<?php
namespace Cl\Log\Logger;

interface LoggerInterpolateInterface
{
    /**
     * Interpolates context values into the message placeholders.
     * 
     * @param string $message message string
     * @param array  $context context
     * 
     * @return string
     */
    function interpolate($message, ?array $context = []): string;
}