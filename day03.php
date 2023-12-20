<?php

/**
 * @link https://adventofcode.com/2023/day/3
 */

$inputs = file('input/day03.txt', FILE_IGNORE_NEW_LINES);

$grid = array_merge(
    [array_fill(0, strlen($inputs[0]) + 2, '.')],
    array_map(fn ($x) => ['.', ...str_split($x), '.'], $inputs),
    [array_fill(0, strlen($inputs[0]) + 2, '.')]
);

$sum = 0;
$row = 0;

foreach ($inputs as $line)
{
    preg_match_all('/(?<num>\d+)/', $line, $matches);
    $offset = 0; // for possible duplicates in same line with strpos()

    foreach ($matches['num'] as $num)
    {
        $startingPos = strpos($line, $num, $offset);
        $offset = $startingPos + 1;
        $numLength = strlen($num);
        $adjacent = [];

        // Same row, left and right adjacent
        $adjacent[] = $grid[$row + 1][$startingPos];
        $adjacent[] = $grid[$row + 1][$startingPos + $numLength + 1];

        // Top and bottom adjacent
        for ($i = $startingPos; $i < $startingPos + $numLength + 2; ++$i)
        {
            $adjacent[] = $grid[$row][$i];
            $adjacent[] = $grid[$row + 2][$i];
        }

        if (count(array_filter($adjacent, fn ($x) => $x !== '.')) > 0)
        {
            $sum += (int) $num;
        }
    }

    ++$row;
}

echo $sum . \PHP_EOL;
