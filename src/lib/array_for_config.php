<?php

function natsort_recursive(&$array) {
    foreach ($array as &$value) {
        if (is_array($value)){
            natsort_recursive($value);
        }
     }
     ksort($array);
}
/**
 * e.g. $path = "somekey:subkey:lastkey"
 *
 * @param array $array
 * @param string $path
 * @return void
 */
function array_get_by_path(array $array, string $path){
    $pathArray = explode('.', $path);
        $ref = &$array;
        foreach ($pathArray as $key){
            if(!isset($ref[$key])){
                return null;
            }
            $ref = &$ref[$key];
        }
       return $ref;
}

function array_add_path(&$array, $pathKey = "___path", $path=''){
    foreach ($array as $k => $v){
        if (is_array($v)){
            $array[$k][$pathKey] = "{$path}:{$k}";
            array_add_path($array[$k], $pathKey, $array[$k][$pathKey]);
        }
    }
}

function array_propagate_recursive(
    array &$array,
    string $nodeKey,
    array $propaganda = [],
    $nodeTargets = false,
    bool $collect = true,
    bool $createIfNotExists = false,
    $parent = false,
    ){
    $nodeTargets = $nodeTargets ? (is_array($nodeTargets) ? $nodeTargets : [$nodeTargets]) : $nodeTargets;
    foreach ($array as $key => $v){
        if (($key == $nodeKey && !$nodeTargets) || ($key == $nodeKey) && (is_array($nodeTargets) && $parent && (in_array($parent,$nodeTargets)))){
            $array[$key] = array_replace_recursive($propaganda, $array[$key]);
            if ($collect){
                $propaganda = $propaganda = $array[$key];
            }
        } elseif (is_array($array[$key])){
                array_propagate_recursive($array[$key], $nodeKey, $propaganda, $nodeTargets, $collect, $createIfNotExists, $key);
        }
        if ($createIfNotExists && count($propaganda) && !isset($array[$nodeKey]) && (!$nodeTargets || (is_array($nodeTargets) && $parent && in_array($parent,$nodeTargets)))){
            $array[$nodeKey] = $propaganda;
        }
    }
}

function array_exctract_to_parent(array &$array, string $nodeKey, bool $overwrite, bool $remove){
    foreach ($array as $key => $v){
        if ($key == $nodeKey){
            if (is_array($array[$key])){
                foreach ($array[$key] as $kk => $vv){
                    if (!isset($array[$kk]) || $overwrite)
                    $array[$kk] = $vv;
                }
                if ($remove){
                    unset($array[$key]);
                }
            }
        } elseif (is_array($array[$key])){
            array_exctract_to_parent($array[$key], $nodeKey, $overwrite, $remove);
        }
    }
}

//function array_propagate