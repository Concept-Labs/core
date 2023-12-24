<?php

/**
 * Utf8 to extended ascii
 *
 * @param string $utf8_str       utf8 string
 * @param array  $replacementMap replacement map [from => to]
 * 
 * @return string
 */
function utf8_to_extended_ascii(string $utf8_str, array &$replacementMap): string
{
    // find all multibyte characters (cf. utf-8 encoding specs)
    $matches = array();
    if (!preg_match_all('/[\xC0-\xF7][\x80-\xBF]+/', $utf8_str, $matches) || !isset($matches[0])) {
        return $utf8_str; // plain ascii string
    }

    // update the encoding map with the characters not already met
    foreach ($matches[0] as $mbc) {
        if (!isset($replacementMap[$mbc])) {
            $replacementMap[$mbc] = chr(128 + count($replacementMap));
        }
    }
    //remap non-ascii characters
    return strtr($utf8_str, $replacementMap);
}

/**
 * Levenstein score function
 *
 * @param string $str1 string 1
 * @param string $str2 string 2
 * 
 * @return int
 */
function levenshtein_utf8(string $str1, string $str2): int
{
    $charMap = array();
    $str1 = utf8_to_extended_ascii($str1, $charMap);
    $str2 = utf8_to_extended_ascii($str2, $charMap);
    
    return levenshtein($str1, $str2);
}