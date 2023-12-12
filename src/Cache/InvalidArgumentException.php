<?php

namespace Cl\Cache;

use Psr\Cache\InvalidArgumentException as PsrCacheInvalidArgumentException;

/**
 * {@inheritDoc}
 */
class InvalidArgumentException extends \InvalidArgumentException 
    implements PsrCacheInvalidArgumentException
{
}
