<?php
namespace Cl\Enum;

/**
 * Enum values trait
 */
trait EnumValuesTrait
{
    /**
     * Enum values array
     *
     * @return array
     */
    public static function values(): array
    {
        return array_map(fn($enum) => $enum->value, static::cases());
    }
}