<?php

declare(strict_types=1);

namespace App\Tests\Test;

use App\Entity\Answer;
use App\Entity\Option;
use App\Entity\OptionId;
use App\Entity\Question;
use App\Entity\Values;
use App\Test\AnswersHolder;
use App\Test\CalculationData;
use App\Test\Calculator;
use App\Test\QuestionsHolder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CalculatorTest extends KernelTestCase
{
    public function testCalculatorResultSet()
    {
        $correctAnswerQuestion = new Question();
        $correctAnswerQuestion->setId(1);
        $correctAnswerQuestion->setText("1 + 1 = ?");
        $correctAnswerQuestion->addOption(
            (new Option())->setId(10)->setText('3')->setIsCorrect(false));
        $correctAnswerQuestion->addOption(
            (new Option())->setId(11)->setText('2')->setIsCorrect(true));
        $correctAnswerQuestion->addOption(
            (new Option())->setId(12)->setText('1')->setIsCorrect(false));

        $incorrectAnswerQuestion = new Question();
        $incorrectAnswerQuestion->setId(2);
        $incorrectAnswerQuestion->setText("1 + 1 = ?");
        $incorrectAnswerQuestion->addOption(
            (new Option())->setId(20)->setText('4')->setIsCorrect(true));
        $incorrectAnswerQuestion->addOption(
            (new Option())->setId(21)->setText('3 + 1')->setIsCorrect(true));
        $incorrectAnswerQuestion->addOption(
            (new Option())->setId(22)->setText('10')->setIsCorrect(false));

        $questions = new QuestionsHolder([
            $correctAnswerQuestion,
            $incorrectAnswerQuestion,
        ]);

        $answers = new AnswersHolder([
            // Correct answer
            Answer::new(1, new Values([
                new OptionId(11),
            ])),
            // Incorrect answer
            Answer::new(2, new Values([
                new OptionId(22),
            ])),
        ]);

        $calculator = new Calculator($answers, $questions);

        self::assertEquals(new CalculationData([
            'correct' => [$correctAnswerQuestion],
            'incorrect' => [$incorrectAnswerQuestion],
        ]), $calculator->calculate());
    }
}
