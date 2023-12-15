<?php

/**
 * @link https://adventofcode.com/2023/day/2
 */

$inputs = file('input/day02.txt', FILE_IGNORE_NEW_LINES);

$sum = 0;

foreach ($inputs as $line)
{
    preg_match('/Game (?<id>\d+): (?<hands>.*)/', $line, $matches);
    $game = (int) $matches['id'];
    $hands = explode(';', $matches['hands']);
    $invalid = false;

    foreach ($hands as $hand)
    {
        preg_match_all('/((?<count>\d+) (?<color>red|green|blue))/', $hand, $matches);
        /** @var array */ $counts = $matches['count'];
        /** @var array */ $colors = $matches['color'];
        $combined = array_combine($colors, $counts) + ['red' => 0, 'green' => 0, 'blue' => 0];

        if ($combined['red'] > 12 || $combined['green'] > 13 || $combined['blue'] > 14)
        {
            $invalid = true;
            break;
        }
    }

    if (!$invalid)
    {
        $sum += $game;
    }
}

echo $sum . \PHP_EOL;
