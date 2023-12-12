<?php

namespace Cl\Cache;

use Psr\Cache\CacheException as PsrCacheException;

/**
 * {@inheritDoc}
 */
class CacheException extends \Exception implements PsrCacheException
{
}
