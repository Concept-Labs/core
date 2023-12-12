<?php
namespace Cl\Config;

use Cl\Enum\EnumJsonSerializableTrait;

interface NodeTagEnumInterface
{
    public static function toOptionsArray(): array;
    //public function tr {similar_text}
}


enum NodeTagEnum: string implements NodeTagEnumInterface
    //implements ArrayAccess
{
    use EnumJsonSerializableTrait;
    case DEFAULT = 'default';
    case COMMON = "___common";
    case LAYOUT = 'layout';
    case VIEW = 'view';
    case TYPE = 'type';
    case TEMPLATE = 'template';

    //public const LAYOUT_TAGS = LayoutEnum::TAG;

    public function __invoke(): array
    {
        return $self::cases();
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getValue(): string
    {
        return $this->value;
    }
    public static function toOptionsArray(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[] = [
                'label' => $case->getName(),
                'value' => $case->getValue()
            ];
        }
        ;
        return $options;
    }
}