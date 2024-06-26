<?php

namespace BrainGames\Even;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\isNumberEven;
use function BrainGames\Engine\runGame;

function runGameEven()
{
    $nameGame = 'Answer "yes" if the number is even, otherwise answer "no".';

    $generateQuestionAndResult = function () {
        $randomNum = getRandomNumber();
        $question = "{$randomNum}";
        $result = isNumberEven($randomNum);

        return [$question, $result];
    };

    runGame($nameGame, $generateQuestionAndResult, 'BrainGames\Engine\comparisonResultByYesOrNo');
}
