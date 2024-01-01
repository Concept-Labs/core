<?php
/**
 * Assert
 * 
 * @category  Library
 * @package   Cl\Assert
 * @author    Victor Galitsky <concept.galitsk@gmail.com>
 * @copyright 2023 (C)oncept-labs
 * @license   MIT 
 * @link      concept-labs-link
 */

namespace Cl\Assert;

/**
 * Assertion helper
 */
class Assert
{

    /**
     * Assert against
     *
     * @param mixed $value The value to check.
     * @param mixed $against The value to check against.
     * @param string|\Stringable|null $throw The exception class to throw on failure.
     * @param mixed ...$throwArguments The arguments to pass to the thrown exception.
     * 
     * @return bool Returns true if the assertion passes.
     * @throws \Throwable Throws an exception if the assertion fails.
     */
    public static function assertAgainst(mixed $value, mixed $against = true, string|\Stringable $throw = null, ...$throwArguments)
    {
        if ($value !== $against) {
            match (true) {
                class_exists((string)$throw) && class_implements(\Throwable::class) => throw new ((string)$throw)(...$throwArguments),
                default => new \Exception("Assertion Failed")
            };
        }
        return true;
    }
}