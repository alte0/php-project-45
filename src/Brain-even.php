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

    $userName = greeting();
    line('Answer "yes" if the number is even, otherwise answer "no".');

    while ($runGame) {
        $randomNum = getRandomNumber();
        $isNumEven = isNumberEven($randomNum);

        line('Question: %s', $randomNum);
        $answer = trim(prompt('Your answer'));
        $isAnswerAny = isAnswerAny($answer);

        if (isWrongAnswer($isNumEven, $answer, $isAnswerAny)) {
            list($text1, $text2) = getWrongText($isNumEven, $answer, $isAnswerAny);
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

function isWrongAnswer(int $isNumEven, string $answer, bool $isAnswerAny): bool
{
    return $isAnswerAny || (!$isNumEven && $answer === 'yes') || ($isNumEven && $answer === 'no');
}

function isAnswerAny(string $answer): bool
{
    $allowAnswers = ['yes', 'no'];
    return !in_array($answer, $allowAnswers);
}

function getWrongText(int $isNumEven, string $answer, bool $isAnswerAny): array
{
    if ($isAnswerAny || (!$isNumEven && $answer === 'yes')) {
        return ['yes', 'no'];
    }

    if ($isNumEven && $answer === 'no') {
        return ['no', 'yes'];
    }

    return ['', ''];
}
