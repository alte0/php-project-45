<?php

namespace BrainGames\Prime;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isPrimeNumber;
use function BrainGames\Engine\runGame;

function runGamePrime()
{
    $nameGame = 'Answer "yes" if given number is prime. Otherwise answer "no".';

    $generateQuestionAndResult = function () {
        $number = getRandomNumber(1, 10);

        $question = $number;
        $result = isPrimeNumber($number);

        return [$question, $result];
    };

    runGame($nameGame, $generateQuestionAndResult, 'BrainGames\Engine\comparisonResultByYesOrNo');
}
