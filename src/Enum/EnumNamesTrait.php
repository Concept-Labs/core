<?php
namespace Cl\Enum;

/**
 * Enum names trait
 */
trait EnumNamesTrait 
{
    /**
     * Enum names
     *
     * @return array
     */
    public static function names(): array
    {
        return array_map(fn($enum) => $enum->name, static::cases());
    }
}