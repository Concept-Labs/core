<?php
namespace Cl\Config;

use Cl\Config\ConfigNode\ConfigNodeInterface;
use Cl\Config\ConfigNode\ConfigNodeAbstract;

class ConfigNode extends ConfigNodeAbstract implements
    ConfigNodeInterface,
    \Cl\Factory\FactorableInterface
{
    public static function factory(...$args): ConfigNode
    {
        return new static(...$args);
    }
}
