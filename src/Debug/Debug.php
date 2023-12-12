<?php
namespace Cl\Debug;

class Debug {
    public $a;

    public static function dump(mixed $value, bool $return = false)
    {
        $out = '';
        ob_start(function ($buffer) use ($out){
            $out = $buffer;
        });

        print_r($value);
        $out = ob_get_flush();
        if (!$return){
            echo '<pre>'.$out.'</pre>';
        }
        return $out;
    }

    public static function socket()
    {
        for ($i = 0; $i < 10; $i++) {
            $msg = yield;
            echo "Recieved $msg";
        }
    }
}