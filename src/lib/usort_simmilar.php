<?php
/**
 * Usort using simmilar_text
 *
 * @param array  $array         array to sort
 * @param string $compareString compare string
 * 
 * @return void
 */
function usort_simmilar(array &$array, string $compareString): void
{
    usort($array, fn($a, $b) => similar_text($compareString, $a) <=> similar_text($compareString, $b));
}

/**
 * Usort using levenshtein
 *
 * @param array  $array         array to sort
 * @param string $compareString compare string
 * 
 * @return void
 */
function usort_levenshtein(array &$array, string $compareString): void
{
    usort($array, fn($a, $b) => levenshtein($compareString, $a) <=> levenshtein($compareString, $b));
}