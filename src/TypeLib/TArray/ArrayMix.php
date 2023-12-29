<?php
namespace Cl\TypeLib\TArray;

use function \key_exists;
use function \explode;

function array_value_by_path(array $array, string $path, string $separator = ".", $isRegex = false): mixed
{
    $reference = &$array;
    foreach (explode($separator, $path) as $key) {
        if (!key_exists($key, $reference)) {
            return null;
        }

        $reference = &$reference[$key];
    }

    return $reference;
}