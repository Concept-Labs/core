<?php
namespace Cl\Able\Iteratorable\ArrayPathIterator;

use ArrayAccess;
use Countable;
use Iterator;
use SeekableIterator;
use Serializable;
use Traversable;

interface ArrayPathIteratorInterface extends SeekableIterator, Traversable, Iterator, ArrayAccess, Serializable, Countable
{
    /**
     * Default path separator.
     */
    const PATH_DEFAULT_SEPARATOR = ".";

}