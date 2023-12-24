<?php
namespace Cl\Able\Filterable\BloomFilter;

use Cl\Able\Filterable\BloomFilter\Able\BloomFilterableTrait;

trait BloomFilterTrait
{
    use BloomFilterableTrait
    {
        BloomFilterableTrait::bloomAdd as add;
        BloomFilterableTrait::bloomMightContains as mightContains;
        BloomFilterableTrait::bloomNotContains as notContains;
    }
}