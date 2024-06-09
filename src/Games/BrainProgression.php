<?php

namespace BrainGames\Progression;

use function BrainGames\Engine\getArithmeticProgression;
use function BrainGames\Engine\getRandomOneElemAndIndexFromArray;
use function BrainGames\Engine\runGame;

function runGameProgression()
{
    $nameGame = 'What number is missing in the progression?';

    $generateQuestionAndResult = function () {
        $arrArithmeticProgression = getArithmeticProgression();
        list($number, $indexNumber) = getRandomOneElemAndIndexFromArray($arrArithmeticProgression);
        $arrArithmeticProgression[$indexNumber] = '..';

        $question = implode(' ', $arrArithmeticProgression);
        $result = $number;

        return [$question, $result];
    };

    runGame($nameGame, $generateQuestionAndResult, '\BrainGames\Engine\generalComparisonResult');
}
