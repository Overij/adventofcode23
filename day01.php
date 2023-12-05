<?php

/**
 * @link https://adventofcode.com/2023/day/1
 */

$inputs = file('input/day01.txt', FILE_IGNORE_NEW_LINES);

$sum1 = 0;
foreach ($inputs as $line)
{
    preg_match_all('/[0-9]/', $line, $matches);
    $sum1 += (int) ($matches[0][0] . $matches[0][count($matches[0]) - 1]);
}

$sum2 = 0;
$help = ['/zero/' => 'z0o', '/one/' => 'o1e', '/two/' => 't2o', '/three/' => 't3e', '/four/' => 'f4r', 
        '/five/' => 'f5e', '/six/' => 's6x', '/seven/' => 's7n', '/eight/' => 'e8t', '/nine/' => 'n9e'];
foreach ($inputs as $line)
{
    $line = preg_replace(array_keys($help), array_values($help), $line);
    preg_match_all('/[0-9]/', $line, $matches);
    $sum2 += (int) ($matches[0][0] . $matches[0][count($matches[0]) - 1]);
}

echo $sum1 . \PHP_EOL . $sum2;
