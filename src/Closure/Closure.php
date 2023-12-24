<?php
namespace Cl\Closure;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;

class Closure
{

    /**
     *
     * @param \Closure $closure closure to isolate
     * 
     * @return mixed
     * 
     * @deprecated 
     */
    #[Deprecated]
    public static function isolate(\Closure $closure): mixed
    {
        return self::invokeCallable($closure);
    }

    /**
     * Invoke a callable.
     *
     * @param callable $callable The callable to bind and invoke.
     *
     * @return string The result of the callable invocation.
     * @throws ClosureException If the callable fails.
     */
    public static function invokeCallable(callable $callable, object|null $newThis = null, object|string|null $newScope="static"): string
    {
        try {
            return \Closure::bind(
                fn() => call_user_func($callable),
                $newThis,
                $newScope
            )();
        } catch (\Throwable $e) {
            throw new ClosureException(
                sprintf('Callable failed: %s', $e->getMessage()),
                (int)$e->getCode(),
                $e
            );
        }
    }

}