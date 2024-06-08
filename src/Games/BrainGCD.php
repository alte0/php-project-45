<?php

namespace BrainGames\GCD;

use function BrainGames\Engine\getGCD;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\runGame;

function runGameGCD()
{
    $nameGame = 'Find the greatest common divisor of given numbers.';

    $generateQuestionAndResult = function () {
        $number1 = getRandomNumber();
        $number2 = getRandomNumber();
        $question = "{$number1} {$number2}";
        $result = getGCD($number1, $number2);

        return [$question, $result];
    };

    runGame($nameGame, $generateQuestionAndResult, '\BrainGames\Engine\generalComparisonResult');
}
