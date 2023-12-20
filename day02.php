<?php

/**
 * @link https://adventofcode.com/2023/day/2
 */

$inputs = file('input/day02.txt', FILE_IGNORE_NEW_LINES);

$sum1 = $sum2 = 0; // Part 1

foreach ($inputs as $line)
{
    preg_match('/Game (?<id>\d+): (?<hands>.*)/', $line, $matches);
    $game = (int) $matches['id'];
    $hands = explode(';', $matches['hands']);
    $invalid = false;
    $red = $green = $blue = 0;

    foreach ($hands as $hand)
    {
        preg_match_all('/((?<count>\d+) (?<color>red|green|blue))/', $hand, $matches);
        /** @var array */ $counts = $matches['count'];
        /** @var array */ $colors = $matches['color'];
        $combined = array_combine($colors, $counts) + ['red' => 0, 'green' => 0, 'blue' => 0];

        // Part 1
        if (!$invalid && $combined['red'] > 12 || $combined['green'] > 13 || $combined['blue'] > 14)
        {
            $invalid = true;
        }

        // Part 2
        $red = max($red, $combined['red']);
        $green = max($green, $combined['green']);
        $blue = max($blue, $combined['blue']);
    }

    if (!$invalid)
    {
        $sum1 += $game;
    }

    $sum2 += ($red * $green * $blue);
}

echo $sum1 . \PHP_EOL . $sum2 . \PHP_EOL;
