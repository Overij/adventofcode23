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

$sum1 = $sum2 = 0;
$row = 0;
$gears = [];

foreach ($inputs as $line)
{
    preg_match_all('/(?<num>\d+)/', $line, $matches);
    $offset = 0; // for possible duplicates in same line with strpos()

    foreach ($matches['num'] as $num)
    {
        $startingPos = strpos($line, $num, $offset);
        $numLength = strlen($num);
        $offset = $startingPos + $numLength;
        $alreadySummed = false;
        $adjacent = [];

        // Same row, left and right adjacent
        $adjacent[] = [$row + 1, $startingPos];
        $adjacent[] = [$row + 1, $startingPos + $numLength + 1];

        // Top and bottom adjacent
        for ($i = $startingPos; $i < $startingPos + $numLength + 2; ++$i)
        {
            $adjacent[] = [$row, $i];
            $adjacent[] = [$row + 2, $i];
        }

        foreach ($adjacent as [$y, $x])
        {
            // Part 1
            if (!$alreadySummed && $grid[$y][$x] !== '.')
            {
                $sum1 += (int) $num;
                $alreadySummed = true;
            }
            
            // Part 2
            if ($grid[$y][$x] === '*')
            {
                $gears[$x . 'x' . $y][] = (int) $num;
            }
        }
    }

    ++$row;
}

$sum2 = array_reduce($gears, fn ($carry, $item) => count($item) == 2 ? $carry + array_product($item) : $carry, 0);

echo $sum1 . \PHP_EOL . $sum2 . \PHP_EOL;
