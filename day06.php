<?php

/**
 * @link https://adventofcode.com/2023/day/6
 */

$inputs = file('input/day06.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Input parsing
$races = [];
preg_match_all('/(?<num>\d+)/', $inputs[0], $matches1);
preg_match_all('/(?<num>\d+)/', $inputs[1], $matches2);
for ($i = 0; $i < count($matches1['num']); ++$i)
{
    $races[] = [(int) $matches1['num'][$i], (int) $matches2['num'][$i]];
}

$winning = [];

// Part 1: Brute force method
foreach ($races as [$time, $distance])
{
    $traveled = [];
    for ($i = 1; $i < $time; ++$i)
    {
        $traveled[] = ($time - $i) * $i;
    }
    $winning[] = count(array_filter($traveled, fn ($x) => $x > $distance));
}
echo array_product($winning) . \PHP_EOL;

// Part 2:
// The formula used in p1 appears to be quadratic so:
// Our formula:     $distance = ($time - $i) * $i
// Rearranged:      $i**2 - $time * $i + $distance = 0
// Standard form:   ax^2 + bx + c = 0
// So:              a = 1, b = -$time, c = $distance

$time = (int) implode('', $matches1['num']);
$distance = (int) implode('', $matches2['num']);

// Quadratic formula
// x1 = (-b + sqrt(b2 - 4ac)) / 2a
// x1 = (-b - sqrt(b2 - 4ac)) / 2a
$x1 = ($time + sqrt($time**2 - 4 * $distance)) / 2;
$x2 = ($time - sqrt($time**2 - 4 * $distance)) / 2;

// $x2 < $x < $x1 so we need to handle floats
$x1 = is_int($x1) ? $x1 - 1 : (int) floor($x1);
$x2 = is_int($x2) ? $x2 + 1 : (int) ceil($x2);

echo (int) ($x1 - $x2 + 1) . \PHP_EOL;
