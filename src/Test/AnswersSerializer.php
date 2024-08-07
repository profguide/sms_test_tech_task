<?php

declare(strict_types=1);

namespace App\Test;

use App\Entity\Answer;
use App\Entity\OptionId;
use App\Entity\Values;

final class AnswersSerializer
{
    public static function serialize(AnswersHolder $answersHolder): string
    {
        return json_encode($answersHolder, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public static function deserialize(string $json): AnswersHolder
    {
        $answers = [];
        foreach (json_decode($json, true) as $row) {
            $answer = new Answer();
            $answer->setQuestionId((int) $row['qId']);
            $values = array_map(function ($value) {
                return new OptionId((int) $value);
            }, $row['values']);
            $answer->setValues(new Values($values));
            $answers[] = $answer;
        }

        return new AnswersHolder($answers);
    }
}
