<?php
namespace Cl\Core\Config\Source;
use Cl\Core\Config\Source\SourceInterface;
class JsonFile implements SourceInterface, \Cl\Core\Factory\FactorableInterface
{
    const CONFIG_FILE_REGEX = "/^.*?\.cfg.json$/i";
    protected $dataArray=[];

    public static function factory(mixed ...$args) : \Cl\Core\Factory\FactorableInterface
    {
        return new static(...$args);
    }
    public function __construct(string $path)
    {
        $this->scanRecurcive($path);
    }

    public function __invoke()
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return $this->dataArray;
    }

    protected function scanRecurcive(string $path) : void
    {
        foreach ( new \RegexIterator(
            new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($path)
            ), 
            static::CONFIG_FILE_REGEX, \RecursiveRegexIterator::GET_MATCH
        ) as $fileMatch ) {
            $this->loadFile($fileMatch[0]);
        }
    }

    protected function loadFile(string $filePath) : void
    {
        $file = new \SplFileObject($filePath);
        $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
        $this->dataArray = array_replace_recursive(
            $this->dataArray,
            json_decode(implode('', iterator_to_array($file)), true)
        );
    }
}