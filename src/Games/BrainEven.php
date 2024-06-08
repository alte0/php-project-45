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

    $conditionResult = function ($answer, $result) {
        $isAnswerAny = isAnswerAny($answer);

        if (isWrongAnswer($result, $answer, $isAnswerAny)) {
            return getTextForWrongAnswer($result, $answer, $isAnswerAny);
        }

        return [];
    };

    runGame($nameGame, $generateQuestionAndResult, $conditionResult);
}

/** Проверка на не правильный ответ
 * @param int $isNumEven
 * @param string $answer
 * @param bool $isAnswerAny
 * @return bool
 */
function isWrongAnswer(int $isNumEven, string $answer, bool $isAnswerAny): bool
{
    return $isAnswerAny || (!$isNumEven && $answer === 'yes') || ($isNumEven && $answer === 'no');
}

/** Проверка на ответ из не списка
 * @param string $answer
 * @return bool
 */
function isAnswerAny(string $answer): bool
{
    $allowAnswers = ['yes', 'no'];
    return !\in_array($answer, $allowAnswers);
}

/** Получение текста для не правильного ответа
 * @param int $isNumEven
 * @param string $answer
 * @param bool $isAnswerAny
 * @return string[]
 */
function getTextForWrongAnswer(int $isNumEven, string $answer, bool $isAnswerAny): array
{
    if ($isAnswerAny || (!$isNumEven && $answer === 'yes')) {
        return ['yes', 'no'];
    }

    if ($isNumEven && $answer === 'no') {
        return ['no', 'yes'];
    }

    return [];
}
