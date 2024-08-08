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
        $question->setId(1);
        $question->addOption((new Option())->setId(1)->setText('1')->setIsCorrect(true));
        $question->addOption((new Option())->setId(2)->setText('2')->setIsCorrect(true));
        $question->addOption((new Option())->setId(3)->setText('3')->setIsCorrect(false)); // << incorrect

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
        $question->addOption((new Option())->setId(1)->setText('1')->setIsCorrect(true));
        $question->addOption((new Option())->setId(2)->setText('2')->setIsCorrect(true));
        $question->addOption((new Option())->setId(3)->setText('3')->setIsCorrect(false)); // << incorrect

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
        $question->addOption((new Option())->setId(1)->setText('1')->setIsCorrect(true));
        $question->addOption((new Option())->setId(2)->setText('2')->setIsCorrect(true));
        $question->addOption((new Option())->setId(3)->setText('3')->setIsCorrect(false)); // << incorrect

        self::assertFalse($answer->isCorrect($question));
    }
}
