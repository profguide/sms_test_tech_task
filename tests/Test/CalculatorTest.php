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
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CalculatorTest extends KernelTestCase
{
    public function testCalculatorResultSet()
    {
        $correctAnswerQuestion = Question::new(1, "1 + 1 = ?", new ArrayCollection([
            Option::new(10, 1, "3", false),
            Option::new(11, 1, "2", true),
            Option::new(12, 1, "0", false),
        ]));

        $incorrectAnswerQuestion = Question::new(2, "2 + 2 = ?", new ArrayCollection([
            Option::new(20, 2, "4", true),
            Option::new(21, 2, "3 + 1", true),
            Option::new(22, 2, "10", false),
        ]));


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
