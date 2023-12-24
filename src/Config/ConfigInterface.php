<?php

namespace Cl\Config;

use Cl\Config\Exception\ConfigNodeNotFoundException;
use Cl\Config\DataProvider\ConfigDataProviderInterface;

/**
 * Interface for configuration management.
 */
interface ConfigInterface
{
    /**
     * Get a configuration value by key.
     *
     * @param string $path    The configuration path.
     * @param mixed  $default The default value if the key is not found.
     *
     * @return mixed The configuration value.
     * @throws ConfigNodeNotFoundException If root node not found
     */
    public function get(string $path, mixed $default = null);

    /**
     * Set a configuration value.
     *
     * @param string $path  The configuration path.
     * @param mixed  $value The configuration value.
     *
     * @return static
     * @throws ConfigNodeNotFoundException If node not found
     */
    public function set(string $path, mixed $value): static;

    /**
     * Check if a configuration key exists.
     *
     * @param string $path The configuration path.
     *
     * @return bool True if the key exists, false otherwise.
     * @throws ConfigNodeNotFoundException If root node not found
     */
    public function has(string $path): bool;

    /**
     * Remove a configuration key.
     *
     * @param string $path The configuration key.
     *
     * @return static
     * @throws ConfigNodeNotFoundException If root node not found
     */
    public function remove(string $path): static;

    /**
     * Get all configuration values.
     *
     * @return mixed All configuration values.
     */
    public function all(): mixed;

    public function addProvider(ConfigDataProviderInterface $provider): static;
    public function load() : static;
    
}