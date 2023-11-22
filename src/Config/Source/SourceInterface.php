<?php
namespace Cl\Core\Config\Source;

interface SourceInterface
{
    /**
     * Get Array
     *
     * @return array
     */
    public function toArray(): array;
}