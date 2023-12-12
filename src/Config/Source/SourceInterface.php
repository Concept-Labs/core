<?php
namespace Cl\Config\Source;

interface SourceInterface
{
    /**
     * Get Array
     *
     * @return array
     */
    public function toArray(): array;
    /**
     * get Config JSON
     *
     * @return string
     */
    public function toJson(): string;
}