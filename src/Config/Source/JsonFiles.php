<?php
namespace Cl\Config\Source;

use Cl\Config\Source\SourceInterface;
use \Cl\Factory\FactorableInterface;
use Throwable;

class JsonFiles implements SourceInterface, FactorableInterface
{
    //const CONFIG_FILE_REGEX = "/^.*?\.cfg\.json$/i";
    const CONFIG_FILE_REGEX = "/.*/i";
    protected $dataArray = [];
    protected $configFiles = [];

    public static function factory(mixed ...$args): FactorableInterface
    {
        return new static(...$args);
    }
    public function __construct(protected array $path)
    {
        $this->setPath($this->path)
            ->scanRecurcive()
            ->loadFiles();
    }

    public function __invoke(): array
    {
        return $this->toArray();
    }

    public function reset()
    {
        $this->dataArray = $this->configFiles = $this->path = [];
    }

    public function setPath(array $path): self
    {
        $this->reset();
        $this->path = $path;
        return $this;
    }
    public function attachConfigFile(string $configFilePath): void
    {
        $this->configFiles[/*$configFilePath*/] = $configFilePath;
    }

    public function toArray(): array
    {
        return $this->dataArray;
    }

    public function toJson(): string
    {
        return json_encode($this->dataArray);
    }

    public function __serialize()
    {
        return $this->toJson();
    }

    public function scanRecurcive(): self
    {
        foreach ($this->path as $path) {
            echo $path;
            foreach (new \RegexIterator(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)), static::CONFIG_FILE_REGEX, \RecursiveRegexIterator::GET_MATCH) as $fileMatch) {
                var_dump($fileMatch);
                if (is_array($fileMatch) && isset($fileMatch[0])) {
                    $this->attachConfigFile($fileMatch[0]);
                }
            }
        }
        return $this;
    }

    public function loadFiles(): self
    {
        foreach ($this->configFiles as $file) {
            $this->loadFile($file);
        }
        return $this;
    }

    public function loadFile(string $filePath): array
    {
        try {
            $file = new \SplFileObject($filePath);
            $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
            $configData = iterator_to_array($file);
        } catch (Throwable $e) {
            
        }
        return $configData ?? [];
    }

    public function mergeConfig(array $configData): self
    {
        $this->dataArray = array_replace_recursive(
            $this->dataArray,
            json_decode(implode('', $configData), true)
        );
        return $this;
    }
}