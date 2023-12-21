<?php

/**
 * @link https://adventofcode.com/2023/day/4
 */

$inputs = file('input/day04.txt', FILE_IGNORE_NEW_LINES);

$sum1 = 0;

// Part 2: Pre-fill cards array with initial card count
$cards = array_fill_keys(range(1, count($inputs)), ['count' => 1]);

foreach ($inputs as $line)
{
    preg_match('/Card\s+(?<id>\d+):\s+(?<winningNumbers>.*)\s+\|\s+(?<playerNumbers>.*)/', $line, $matches);
    $card = (int) $matches['id'];
    $winningNumbers = preg_split('/\s+/', $matches['winningNumbers']);
    $playerNumbers = preg_split('/\s+/', $matches['playerNumbers']);
    $intersect = array_intersect($winningNumbers, $playerNumbers);

    // Part 1
    $sum1 += min(1, count($intersect)) * pow(2, count($intersect) - 1);

    // Part 2
    for ($i = 0; $i < $cards[$card]['count']; ++$i)
    {
        for ($j = 0; $j < count($intersect); ++$j)
        {
            $cards[$card + $j + 1]['count']++;
        }
    }
}

$sum2 = array_sum(array_map(fn ($x) => $x['count'], $cards));

echo $sum1 . \PHP_EOL . $sum2 . \PHP_EOL;
