<?php
namespace Cl\Enum;

/**
 * Enum Json Serializable Trait
 */
trait EnumJsonSerializableTrait
{
    use EnumArraySerializableTrait;
     
    /**
     * JSON serialize
     *
     * @return string
     */
    public static function jsonSerialize(): string
    {
        return json_encode(static::array());
    }
}