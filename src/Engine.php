<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

/** Главная функция запуска игры
 * @param string $nameGame имя игры
 * @param callable $fn функция генерации вопроса и правильного ответа [$question, $result]
 * @param callable $fn2 функция проверки ответа на вопрос
 * @param int $numberCorrectAnswers количество правильных ответов для окончания игры
 * @return void
 */
function runGame(string $nameGame, callable $fn, callable $fn2, int $numberCorrectAnswers = 3): void
{
    $runGame = true;
    $countCorrectAnswers = 0;

    $userName = greeting();
    line($nameGame);

    while ($runGame) {
        list($question, $result) = \call_user_func($fn);

        if ($question && $result) {
            $answer = getAnswerByQuestion($question);
            $text = \call_user_func($fn2, $answer, $result);
        }

        if (!empty($text)) {
            list($text1, $text2) = $text;
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $text1, $text2);
            line('Let\'s try again, %s!', $userName);

            break;
        } else {
            $countCorrectAnswers++;
            line('Correct!');
        }

        if ($countCorrectAnswers === $numberCorrectAnswers) {
            $runGame = false;
            line('Congratulations, %s!', $userName);
        }
    }
}

/** Приветствие игрока
 * @return string
 */
function greeting(): string
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);

    return $userName;
}

/** Получение ответа на вопрос
 * @param $question
 * @return string
 */
function getAnswerByQuestion($question): string
{

    line('Question: %s', $question);

    return \trim(prompt('Your answer'));
}

/** Случайное число в указанном диапазоне
 * @param int $minNumber
 * @param int $maxNumber
 * @return int
 */
function getRandomNumber(int $minNumber = 1, int $maxNumber = 15): int
{
    return rand($minNumber, $maxNumber);
}

/** Чётное ли число
 * @param int $number
 * @return bool
 */
function isNumberEven(int $number): bool
{
    return $number % 2 === 0;
}

/** Случайный элемент из массива
 * @param array $arr
 * @return string
 */
function getRandomOneElemFromArray(array $arr = []): string
{
    $index = array_rand($arr, 1);

    return $arr[$index];
}

/** Калькулятор
 * @param int $number
 * @param string $operation
 * @param int $number2
 * @return int
 */
function calculate(int $number, string $operation, int $number2): int
{
    $result = 0;

    if (empty($operation)) {
        return $result;
    }

    switch ($operation) {
        case '+':
            $result = $number + $number2;
            break;
        case '-':
            $result = $number - $number2;
            break;
        case '*':
            $result = $number * $number2;
            break;
        case '/':
            if ($number2 !== 0) {
                $result = $number / $number2;
            }
            break;
    }

    return $result;
}
