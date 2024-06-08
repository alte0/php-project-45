<?php

namespace BrainGames\Calc;

use function BrainGames\Engine\calculate;
use function BrainGames\Engine\getRandomOneElemFromArray;
use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\runGame;

function runGameCalc()
{
    $nameGame = 'What is the result of the expression?';

    $generateQuestionAndResult = function () {
        $arrOperations = ['+', '-', '*'];
        $operation = getRandomOneElemFromArray($arrOperations);
        $number1 = getRandomNumber();
        $number2 = getRandomNumber();
        $question = "{$number1} {$operation} {$number2}";
        $result = calculate($number1, $operation, $number2);

        return [$question, $result];
    };

    runGame($nameGame, $generateQuestionAndResult, '\BrainGames\Engine\generalComparisonResult');
}
