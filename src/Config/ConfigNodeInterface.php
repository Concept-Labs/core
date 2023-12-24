<?php
namespace Cl\Config;

interface ConfigNodeInterface
{

    /**
     * Get the value of the node or a nested node by path.
     * 
     * @param mixed|null $default The default value
     *
     * @return mixed|null The value of the node
     */
    public function get(mixed $default = null): mixed;


    /**
     * Set the value of the node.
     *
     * @param mixed $data The value to set for the node.
     *
     * @return static The current instance for fluent interface.
     */
    public function set($data): static;

    /**
     * Get the path for the node.
     *
     * @return string string to set.
     */
    public function getPath(): string;

}