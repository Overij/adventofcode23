<?php

/**
 * @link https://adventofcode.com/2023/day/8
 */

$inputs = file('input/day08.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$instructions = array_shift($inputs);
$nodes = [];
foreach ($inputs as $line)
{
    preg_match('/(?<node>[A-Z]{3}) = \((?<left>[A-Z]{3}), (?<right>[A-Z]{3})\)/', $line, $matches);
    $nodes[$matches['node']] = ['L' => $matches['left'], 'R' => $matches['right']];
}

$steps = 0;
$node = 'AAA';
for ($i = 0; ; ++$i)
{
    if ($i == strlen($instructions))
    {
        $i = 0;
    }

    ++$steps;

    $node = $nodes[$node][$instructions[$i]];
    if ($node === 'ZZZ')
    {
        break;
    }
}

echo $steps . \PHP_EOL;
