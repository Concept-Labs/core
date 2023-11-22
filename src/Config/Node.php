<?php
namespace Cl\Core\Config;

class Node extends Node\NodeAbstract implements Node\NodeInterface, \Cl\Core\Factory\FactorableInterface
{
    public static function factory(...$args): Node
    {
        return new static(...$args);
    }
}
