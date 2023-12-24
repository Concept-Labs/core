<?php

namespace Cl\Config\DataProvider\Json;

use Cl\Config\DataProvider\ConfigDataProviderInterface;

/**
 * Configuration provider from JSON file.
 */
class JsonConfigProvider implements ConfigDataProviderInterface
{
    /**
     * @var string Path to the JSON file.
     */
    protected string $filePath;

    /**
     * Constructor.
     *
     * @param string $filePath Path to the JSON file.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * {@inheritdoc}
     */
    public function load(): array
    {
        $jsonContent = file_get_contents($this->filePath);

        return json_decode($jsonContent, true) ?: [];
    }

    /**
     * {@inheritDoc}
     */
    public function save(array $data): bool
    {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));
        return true;
    }
}