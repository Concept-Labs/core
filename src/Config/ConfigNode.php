<?php

namespace Cl\Config;

use Cl\Callable\Stringable\StringExtractorTrait;

/**
 * Implementation of the ConfigNodeInterface representing a node in a configuration tree.
 */
class ConfigNode implements ConfigNodeInterface
{
    use StringExtractorTrait;
    /**
     * Constructor.
     *
     * @param mixed                       $data The initial data for the node.
     * @param string|\Stringable|callable $path The node path. 
     *                                          Used to store path when creating instance from Config search by path
     */
    public function __construct(protected mixed $data, readonly protected string $path = '')
    {
        //initialization of readonly properties
    }

    /**
     * {@inheritDoc}
     */
    public function get(mixed $default = null): mixed
    {
        return match (true) {
            is_null($this->data) => $default,
            default => $this->data,
        };
    }

    /**
     * {@inheritDoc}
     */
    public function set(mixed $value): static
    {
        $this->data = is_object($value) ? clone $value : $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPath(): string
    {
        return $this->path;
    }

}