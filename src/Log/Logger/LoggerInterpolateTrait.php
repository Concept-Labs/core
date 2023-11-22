<?php
namespace Cl\Core\Log\Logger;

trait LoggerInterpolateTrait
{
    /**
     * Interpolates context values into the message placeholders.
     * 
     * @param string $message message string
     * @param array  $context context
     * 
     * @return string
     */
    function interpolate($message, ?array $context = []): string
    {
        $replace = [];
        foreach ($context as $key => $val) {
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }
        return strtr($message, $replace);
    }
}