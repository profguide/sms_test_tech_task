<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Answer;
use App\Entity\Option;
use App\Entity\OptionId;
use App\Entity\Question;
use App\Entity\Values;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class AnswerTest extends KernelTestCase
{
    public function testSuccessWhenAnswerContainsOnlyCorrectOne()
    {
        $answer = new Answer();
        $answer->setValues(
            new Values([
                new OptionId(1),
            ])
        );

        $question = new Question();
        $question->setOptions(new ArrayCollection([
            Option::new(1, 1, "1", true),
            Option::new(2, 1, "1", true),
            Option::new(3, 1, "1", false), // << incorrect
        ]));

        self::assertTrue($answer->isCorrect($question));
    }

    public function testSuccessWhenAnswerContainsOnlyCorrectFew()
    {
        $answer = new Answer();
        $answer->setValues(
            new Values([
                new OptionId(1),
                new OptionId(2),
            ])
        );

        $question = new Question();
        $question->setOptions(new ArrayCollection([
            Option::new(1, 1, "1", true),
            Option::new(2, 1, "1", true),
            Option::new(3, 1, "1", false), // << incorrect
        ]));

        self::assertTrue($answer->isCorrect($question));
    }

    public function testFailWhenAnswerContainsCorrectAndIncorrect()
    {
        $answer = new Answer();
        $answer->setValues(
            new Values([
                new OptionId(1),
                new OptionId(3), // << incorrect
            ])
        );

        $question = new Question();
        $question->setOptions(new ArrayCollection([
            Option::new(1, 1, "1", true),
            Option::new(2, 1, "1", true),
            Option::new(3, 1, "1", false), // << incorrect
        ]));

        self::assertFalse($answer->isCorrect($question));
    }
}
