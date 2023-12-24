<?php
namespace Cl\Callable\Stringable;

use Cl\Callable\Exception\InvalidArgumentException;
use Cl\Callable\Exception\InvalidInvokeReturnTypeException;
use Cl\Closure\Closure;

trait StringExtractorTrait
{
    /**
     * Normalize the given path.
     *
     * @param \Stringable|string|callable $string_or_callable The string or callable to extcract from.
     *
     * @return string The normalized path.
     * @throws InvalidAgrumentException If the argument is of an invalid type.
     * @throws InvalidInvokeReturnTypeException If the callable argument return invalid type after being invoked.
     */
    protected static function bindAndExtractString(\Stringable|string|callable $string_or_callable, object|null $newThis = null, object|string|null $newScope = null): string
    {
        $string = match (true) {
            is_string($string_or_callable) || $string_or_callable instanceof \Stringable => (string) $string_or_callable,
            is_callable($string_or_callable) => (string)Closure::invokeCallable($string_or_callable, $newThis, $newScope),
            default => throw new InvalidArgumentException("Invalid argument was passed to ConfigNode::get()"),
        };

        if (!is_string((string)$string)) {
            throw new InvalidInvokeReturnTypeException("Callable argument for extractr must return type string or Stringable");
        }
        return $string;
    }
}