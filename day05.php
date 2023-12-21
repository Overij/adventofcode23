<?php

/**
 * @link https://adventofcode.com/2023/day/5
 */

$inputs = file('input/day05.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

preg_match_all('/(?<seed>\d+)/', $inputs[0], $matches);
$seeds = $matches['seed'];
$maps = [
    'seed-to-soil' => [],
    'soil-to-fertilizer' => [],
    'fertilizer-to-water' => [],
    'water-to-light' => [],
    'light-to-temperature' => [],
    'temperature-to-humidity' => [],
    'humidity-to-location' => []
];
$locations1 = $locations2 = [];

// Map parsing
for ($i = 1; $i < count($inputs); ++$i)
{
    if (preg_match('/(?<map>.*) map:/', $inputs[$i], $matches))
    {
        $pointer = &$maps[$matches['map']];
        continue;
    }

    preg_match('/(?<dest>\d+)\s+(?<src>\d+)\s+(?<len>\d+)/', $inputs[$i], $matches);
    $pointer[] = [(int) $matches['dest'], (int) $matches['src'], (int) $matches['len']];
}
unset($pointer);

// Part 1: Start plotting course from seed onward till location
foreach ($seeds as $seed)
{
    $number = (int) $seed;
    foreach ($maps as $map)
    {
        $number = plot($number, $map);
    }
    $locations1[] = $number;
}

// Part 2:
foreach (array_chunk($seeds, 2) as [$src, $len])
{
    
}

function plot(int $num, array $map) : int
{
    foreach ($map as [$dest, $src, $len])
    {
        // Check if number is in source range
        if ($num >= $src && $num <= ($src + $len - 1))
        {
            $num = $dest + $num - $src;
            break;
        }
    }
    return $num;
}

function plot2(int $src, int $len, $map) : array
{
    $ranges = [];

    foreach ($map as [$dest, $src, $len])
    {
        
    }


    return $ranges;
}

echo min($locations1) . \PHP_EOL . min($locations2) . \PHP_EOL;
