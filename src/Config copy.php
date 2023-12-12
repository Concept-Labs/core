<?php
/**
 * Config
 */
//namespace Cl\Config;

/**
 * Undocumented class
 */
//class Config implements Interface\Config, Cl\Factory\Interface\Factorable
{

    const CFG_NODE_COMMON = "___common";
    const CFG_NODE_DEFAULT = 'default';
    const CFG_NODE_LAYOUT = 'layout';
    const CFG_NODE_VIEW = 'view';
    const CFG_NODE_TYPE = 'type';
    const CFG_NODE_TEMPLATE = 'template';

    /**
     * Loaded configs
     *
     * @var array
     */
    protected static $loaded = false;
    protected static $files = [];
    protected static $config = [];


    /**
     * Args
     * 
     * Args @param  mixed ...$args
     * 
     * @return \Cl\Config
     */
    public static function factory(...$args)
    {
        return new static(...$args);
    }

    /**
     * Set loaded
     * 
     * @param bool $loaded bool loaded
     * 
     * @return void
     */
    public static function loaded(bool $loaded = true): bool
    {
        return static::$loaded = (bool)$loaded;
    }

    /**
     * Check loaded
     * 
     * @return bool
     */
    public static function isLoaded(): bool
    {
        return static::$loaded;
    }

    /**
     
     * @param string|null $path
     * @return array
     */
    public static function getConfig(): array
    {
        return static::$config;
    }

    /**
     * @param string|null $dir
     * @return void
     */
    public static function load(string $dir = null, bool $force = false): void
    {
        if (!$force && static::isLoaded()) {
            return;
        }
        static::_load($dir);

        static::validate();

        static::propagateData();
        array_multisort(static::$config);
    }

    /**
     * @param string|null $dir
     * @return void
     */
    protected static function _load(string $dir = null)
    {
        $files = glob(($dir ?: static::getDefaultLoadDir()) . '*', GLOB_BRACE | GLOB_MARK);
        foreach ($files as $file) {
            match (true) {
                str_ends_with($file, CL_CONFIG_FILES) => static::loadFile($file), //yield $file,
                is_dir($file) => static::_load($file),
                default => null,
            };
        }
        static::loaded();
    }

    /**
     * @param string $file
     * @return void
     */
    public static function loadFile(string $file): void
    {
        try {
            $json = file_get_contents($file);
            static::$config = array_replace_recursive(
                static::$config,
                json_decode($json, true)
            );
        } catch (Throwable $e) {
            throw new \Exception("Config: Failed to load file ({$file}): " . $e->getMessage());
        }
        static::$files[$file] = $file;
    }

    /**
     * @return void
     */
    protected static function validate(): void
    {
        $mandatoryNodes = [
            'route'
        ];
        foreach ($mandatoryNodes as $node) {
            if (!isset(static::$config[$node]) || !is_array(static::$config[$node]) || !count(static::$config[$node])) {
                throw new \Exception("Cofig error: one or more config nodes are absent or invalid. Check config files.");
            }
        }
    }

    /**
     * @return string
     */
    public static function getDefaultLoadDir(): string
    {
        //@TODO correct dir
        return __DIR__ . '/../';
    }

    /**
     * e.g. $path="somekey:somesubkey:key"
     *
     * @param string|null $path
     * @return mixed
     */
    public static function node(string ...$path): mixed
    {
        if (!static::isLoaded()) {
            static::load();
        }
        if (!$path) {
            return static::$config;
        }
        $nodePath = array_reduce(
            $path,
            function ($nodePath, $v) {
                $nodePath .= $nodePath ? ":$v" : $v;
                return $nodePath;
            }
        );

        return array_get_by_path(static::$config, trim(trim($nodePath, ':')));
    }

    /**
     *
     * @param array $from
     * @param string ...$path
     * @return mixed
     */
    public static function nodeFrom(array $from, string ...$path): mixed
    {
        $nodePath = array_reduce(
            $path,
            function ($nodePath, $v) {
                $nodePath .= $nodePath ? ":$v" : $v;
                return $nodePath;
            }
        );

        return array_get_by_path($from, $nodePath);
    }

    /**
     * @param string ...$path
     * @return mixed
     */
    public static function nodeBubble(string ...$path): mixed
    {
        $parts = explode(
            ':',
            array_reduce(
                $path,
                function ($nodePath, $v) {
                    $nodePath .= $nodePath ? ":$v" : $v;
                    return trim($nodePath, ':');
                }
            )
        );
        $last = array_pop($parts);
        do {
            $path = implode(':', $parts);
            $path .= $path ? ":{$last}" : $last;
            $node = static::node($path);
            if ($node) {
                return $node;
            }
        } while (array_pop($parts));
        return null;
    }

    /**
     *
     * @return void
     */
    public static function propagateData(): void
    {
        //add path to "___orig_path" node. e.g. "some_node:subnode:subsubnode"
        array_add_path(static::$config, "___orig_path");

        // prpagate layout
        array_propagate_recursive(
            static::$config,
            static::CFG_NODE_LAYOUT,
            isset(static::$config[static::CFG_NODE_LAYOUT]) ? static::$config[static::CFG_NODE_LAYOUT] : []
        );

        //propagate "___common node
        array_propagate_recursive(
            static::$config,
            '___common',
            isset(static::$config[static::CFG_NODE_COMMON]) ? static::$config[static::CFG_NODE_COMMON] : [],
            false,
            true,
            true
        );

        // extract ___commons as normal nodes
        array_exctract_to_parent(static::$config, static::CFG_NODE_COMMON, false, false);

        //add path to "___path" node. e.g. "some_node:subnode:subsubnode"
        array_add_path(static::$config, "___path");

        static::nodeBubble(':factory:namespaces', 'core:___common:loenv:');
    }
}