<?php

declare(strict_types=1);

namespace App\Tests\Test;

use App\Entity\Answer;
use App\Entity\OptionId;
use App\Entity\Values;
use App\Test\AnswersHolder;
use App\Test\AnswersSerializer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class AnswersSerializerTest extends KernelTestCase
{
    public function testSerialize()
    {
        $holder = new AnswersHolder([
            self::buildAnswer(1, [1]),
            self::buildAnswer(2, [2, 3]),
        ]);

        $jsonExpect = '[{"qId":1,"values":[1]},{"qId":2,"values":[2,3]}]';

        self::assertEquals(AnswersSerializer::serialize($holder), $jsonExpect);
    }

    public function testDeserialize()
    {
        $json = '[{"qId":1,"values":[1]},{"qId":"2","values":["2","3"]}]';

        $holder = new AnswersHolder([
            self::buildAnswer(1, [1]),
            self::buildAnswer(2, [2, 3]),
        ]);

        self::assertEquals(AnswersSerializer::deserialize($json), $holder);
    }

    private static function buildAnswer(int $qId, array $values): Answer
    {
        $answer = new Answer();
        $answer->setQuestionId($qId);
        $answer->setValues(new Values(array_map(function ($value): OptionId {
            return new OptionId($value);
        }, $values)));
        return $answer;
    }
}
