<?php

/**
 * @link https://adventofcode.com/2023/day/7
 */

$inputs = file('input/day07.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Input processing
$hands = [];
foreach ($inputs as $line)
{
    $parts = explode(' ', $line);
    $hand = [];
    $hand[] = str_replace(
        ['A', 'K', 'Q', 'J', 'T'],
        [14, 13, 12, 11, 10],
        str_split($parts[0])
    );
    $hand[] = (int) $parts[1];
    // Calc card counts and sort counts in ascending order
    $hand[] = array_count_values($hand[0]);
    sort($hand[2]);
    $hand[] = -1; // Hand type
    $hands[] = $hand;
}

// Value table for each type:
// 6 - Five of a kind
// 5 - Four of a kind
// 4 - Full house
// 3 - Three of a kind
// 2 - Two pair
// 1 - One pair
// 0 - High card
// Start from strongest type and move down
foreach ($hands as [$cards, $strength, $counts, &$type])
{
    if (count($counts) == 1)                        $type = 6;
    elseif (count($counts) == 2 && $counts[1] == 4) $type = 5;
    elseif (count($counts) == 2)                    $type = 4;
    elseif (count($counts) == 3 && $counts[2] == 3) $type = 3;
    elseif (count($counts) == 3 && $counts[2] == 2) $type = 2;
    elseif (count($counts) == 4)                    $type = 1;
    else                                            $type = 0;
}

// Sort hands, same types require extra comparing
usort($hands, function ($a, $b) {
    if ($a[3] == $b[3])
    {
        // Equal type
        for ($i = 0; $i < 5; ++$i)
        {
            if ($a[0][$i] == $b[0][$i]) continue;
            elseif ($a[0][$i] < $b[0][$i]) return -1;
            else return 1;
        }
    }
    if ($a[3] < $b[3]) return -1;
    return 1;
});

$sum = 0;
$rank = 1;
foreach ($hands as [, $strength, ,])
{
    $sum += $strength * $rank++;
}

echo $sum . \PHP_EOL;
