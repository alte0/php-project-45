<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function greeting(): string
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);

    return $userName;
}

function getRandomNumber(int $minNumber = 1, int $maxNumber = 15): int
{
    return rand($minNumber, $maxNumber);
}

function isNumberEven(int $number): bool
{
    return $number % 2 === 0;
}
