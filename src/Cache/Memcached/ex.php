<?php
public static function isSupported(): bool
{
    return \extension_loaded('memcached') && version_compare(phpversion('memcached'), '3.1.6', '>=');
}