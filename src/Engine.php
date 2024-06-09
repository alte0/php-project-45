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

        $answer = getAnswerByQuestion($question);
        $text = \call_user_func($fn2, $answer, $result);

        if (is_array($text) && count($text) > 0) {
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
 * @param string $question
 * @return string
 */
function getAnswerByQuestion(string $question): string
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
 * @return mixed
 */
function getRandomOneElemFromArray(array $arr = [])
{
    $index = array_rand($arr, 1);

    return $arr[$index];
}

/** Случайный элемент из массива с его случайным индексом
 * @param array $arr
 * @return array элемент и индекс
 */
function getRandomOneElemAndIndexFromArray(array $arr = []): array
{
    $index = array_rand($arr, 1);

    return [$arr[$index], $index];
}

/** Калькулятор
 * @param int $number
 * @param string $operation
 * @param int $number2
 * @return int
 */
function calculate(int $number, string $operation, int $number2): int
{
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
            $result = $number / $number2;
            break;
        default:
            $result = 0;
            break;
    }

    return $result;
}

/** Получение наибольшего общего делителя
 * @param int $number1
 * @param int $number2
 * @return int
 */
function getGCD(int $number1, int $number2): int
{
    $maxNumber = \max($number1, $number2);
    $minNumber = \min($number1, $number2);

    return calculateMostCommonDivisorByTwoNumbers($maxNumber, $minNumber);
}

/** Вычисление наибольшего общего делителя из 2 чисел
 * @param int $number1 наибольшее из чисел
 * @param int $number2 наименьшее из чисел
 * @return int
 */
function calculateMostCommonDivisorByTwoNumbers(int $number1, int $number2): int
{
    $remainder = $number1 % $number2;

    if ($remainder === 0) {
        return $number2;
    } else {
        $remainder = calculateMostCommonDivisorByTwoNumbers($number2, $remainder);
    }

    return $remainder;
}

/** Общее условие для чисел
 * @param string $answer
 * @param int $result
 * @return array|int[]
 */
function generalComparisonResult(string $answer, int $result): array
{
    if ((int)$answer !== $result) {
        return [$answer, $result];
    }

    return [];
}

/** Проверка ответов по yes или no
 * @param string $answer
 * @param bool $result
 * @return array|string[]
 */
function comparisonResultByYesOrNo(string $answer, bool $result): array
{
    $isAnswerAny = isAnswerAny($answer);

    if (isWrongAnswer($result, $answer, $isAnswerAny)) {
        return getTextForWrongAnswer($result, $answer, $isAnswerAny);
    }

    return [];
}

/** Проверка на не правильный ответ
 * @param bool $isResult
 * @param string $answer
 * @param bool $isAnswerAny
 * @return bool
 */
function isWrongAnswer(bool $isResult, string $answer, bool $isAnswerAny): bool
{
    return $isAnswerAny || (!$isResult && $answer === 'yes') || ($isResult && $answer === 'no');
}

/** Проверка на ответ из не списка
 * @param string $answer
 * @return bool
 */
function isAnswerAny(string $answer): bool
{
    $allowAnswers = ['yes', 'no'];
    return !\in_array($answer, $allowAnswers, true);
}

/** Получение текста для не правильного ответа
 * @param bool $isResult
 * @param string $answer
 * @param bool $isAnswerAny
 * @return string[]
 */
function getTextForWrongAnswer(bool $isResult, string $answer, bool $isAnswerAny): array
{
    if ($isAnswerAny || (!$isResult && $answer === 'yes')) {
        return ['yes', 'no'];
    }

    if ($isResult && $answer === 'no') {
        return ['no', 'yes'];
    }

    return [];
}

/** Получение массива с арифметической прогрессией и разностью арифметической прогрессии
 * @return array
 */
function getArithmeticProgression(): array
{
    $lengthProgression = getRandomNumber(5, 10);
    $firstMemberProgression = getRandomNumber(1, 50);
    $differenceArithmeticProgression = getRandomNumber(-5, 5);
    $prevMemberProgression = $firstMemberProgression;
    $arr = [];

    for ($i = 0; $i < $lengthProgression; $i++) {
        $prevMemberProgression = $prevMemberProgression + $differenceArithmeticProgression;
        $arr[] = $prevMemberProgression;
    }

    return $arr;
}

/** Простое ли число
 * @param int $number
 * @return bool
 */
function isPrimeNumber(int $number): bool
{
    if ($number == 2) {
        return true;
    }

    if (($number == 1) || ($number % 2 == 0)) {
        return false;
    }

    $ceil = \ceil(\sqrt($number));

    for ($i = 3; $i <= $ceil; $i = $i + 2) {
        if ($number % $i == 0) {
            return false;
        }
    }

    return true;
}
