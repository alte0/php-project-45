<?php

namespace BrainGames\Cli;

use function BrainGames\Engine\getRandomNumber;
use function BrainGames\Engine\greeting;
use function BrainGames\Engine\isNumberEven;
use function cli\line;
use function cli\prompt;

function runBrainEven()
{
    $runGame = true;
    $countCorrectAnswers = 0;
    $numberCorrectAnswers = 3;
    $allowAnswers = ['yes', 'no'];

    $userName = greeting();
    line('Answer "yes" if the number is even, otherwise answer "no".');

    while ($runGame) {
        $randomNum = getRandomNumber();
        $isNumEven = isNumberEven($randomNum);

        line('Question: %s', $randomNum);
        $answer = trim(prompt('Your answer'));

        $isAnswerAny = !in_array($answer, $allowAnswers);
        $isStopGame = false;

        if ($isNumEven && $answer === 'no') {
            $text1 = 'no';
            $text2 = 'yes';
            $isStopGame = true;
        } elseif ((!$isNumEven && $answer === 'yes') || $isAnswerAny) {
            $text1 = 'yes';
            $text2 = 'no';
            $isStopGame = true;
        }

        if ($isStopGame) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $text1, $text2);
            line('Let\'s try again, %s!', $userName);

            break;
        }

        $countCorrectAnswers++;
        line('Correct!');

        if ($countCorrectAnswers === $numberCorrectAnswers) {
            $runGame = false;
            line('Congratulations, %s!', $userName);
        }
    }
}
