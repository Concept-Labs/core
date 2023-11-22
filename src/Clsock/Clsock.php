<?php
namespace Cl\Core\Clsock;

class Clsock
{

    protected static $subscriberMap=[];
    public static function register($clst_message, $config)
    {
        static::$subscriberMap[spl_object_hash($config)];
    }
    public static function dispatch($clst_message)
    {

    } 
    public static function open()
    {

    }

    public static function socket()
    {
        while (true) {
            $msg = yield;
            var_dump($msg);
        }
    }   
}