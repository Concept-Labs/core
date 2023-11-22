<?php
namespace Cl\Core\Log;

use Cl\Core\Debug\Debug;

use Throwable;

class Log{

    const LEVEL_LOG = '';
    const LEVEL_WARNING = 'WARNING';
    const LEVEL_ERROR = 'ERROR';
    protected static $enabled=false;

    public static function enabled()
    {
        return self::$enabled;
    }
    public static function enable()
    {
        self::$enabled = true;
    }
    public static function disable()
    {
        self::$enabled = false;
    }

    public static function log(mixed $value, $level = null, $filename = null)
    {
        if (!self::enabled()){
            return;
        }
        $level = $level ?: self::LEVEL_LOG;
        $time = date('d-m-y h:i:s');
        $dump = Debug::dump($value, true);
        $logStr = "[{$time}][{$level}] {$dump}";
        $logFile = self::getLogFile($filename);
        try{
            file_put_contents($logFile, $logStr.PHP_EOL, FILE_APPEND | LOCK_EX);
        } catch (Throwable $e) {
            //do nothing
        }
    }

    public static function logException(mixed $value, $level = self::LEVEL_ERROR, $filename = null)
    {
        self::log($value,$level,$filename ?: 'cl.exception.log');
    }

    

    public static function getLogFile($filename = null){
        $filename = $filename ?: 'cl.system.log';
        if(!str_ends_with($filename,'.log')){
            $filename.='.log';
        }
        $logFile = static::getPath().$filename;
        @mkdir(dirname($logFile), 0755, true);
        return $logFile;
    }

    protected static function getPath()
    {
        $vendor = explode('\\',__CLASS__)[0];
            $vendorPattern = strtolower($vendor);
            $vendorPath = CL_LOG_DIR;
        return $vendorPath;
    }
}