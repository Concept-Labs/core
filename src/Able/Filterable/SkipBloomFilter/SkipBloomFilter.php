<?php
namespace Cl\Able\Filterable\SkipBloomFilter;

class SkipBloomFilter 
{
    private array $sections;
    private int $sectionSize;
    private int $hashFunctions;

    public function __construct(int $sectionSize, int $hashFunctions) 
    {
        $this->sectionSize = $sectionSize;
        $this->hashFunctions = $hashFunctions;
        $this->sections = [];
    }

    public function add(string $item) 
    {
        for ($i = 0; $i < $this->hashFunctions; $i++) {
            $hash = $this->hashFunction($item . $i);
            $sectionIndex = $hash % $this->sectionSize;
            $this->sections[$sectionIndex][$hash] = 1;
        }
    }

    public function contains(string $item): bool 
    {
        for ($i = 0; $i < $this->hashFunctions; $i++) {
            $hash = $this->hashFunction($item . $i);
            $sectionIndex = $hash % $this->sectionSize;

            if (!isset($this->sections[$sectionIndex][$hash])) {
                return false;  
            }
        }

        return true;
    }

    private function hashFunction(string $input): int 
    {
        return crc32($input);
    }
}