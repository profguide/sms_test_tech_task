<?php

declare(strict_types=1);

namespace App\Entity;

final class Answer implements \JsonSerializable
{
    private int $questionId;

    private Values $values;

    public static function new(int $questionId, Values $values): Answer
    {
        $answer = new Answer();
        $answer->questionId = $questionId;
        $answer->values = $values;

        return $answer;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function setQuestionId(int $questionId): void
    {
        $this->questionId = $questionId;
    }

    public function getValues(): Values
    {
        return $this->values;
    }

    public function setValues(Values $values): void
    {
        $this->values = $values;
    }

    /**
     * Checks the answer for correct/incorrect.
     * The correct answer is considered to be one that doesn't contain any incorrect values.
     * @param Question $question
     * @return bool
     */
    public function isCorrect(Question $question): bool
    {
        $correctOptions = [];
        /**@var Option $option */
        foreach ($question->getOptions() as $option) {
            if ($option->getIsCorrect()) {
                $correctOptions[$option->getId()] = $option;
            }
        }

        foreach ($this->getValues()->values as $value) {
            if (!array_key_exists($value->id, $correctOptions)) {
                return false;
            }
        }

        return true;
    }

    public function jsonSerialize(): mixed
    {
        return ['qId' => $this->questionId, 'values' => $this->values];
    }
}
