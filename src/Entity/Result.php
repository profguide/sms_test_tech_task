<?php

declare(strict_types=1);

namespace App\Entity;

use App\Test\AnswersHolder;
use App\Test\AnswersSerializer;

final class Result
{
    private string $answers;

    public function getAnswers(): string
    {
        return $this->answers;
    }

    public function setAnswers(string $answers): void
    {
        $this->answers = $answers;
    }

    public function getAnswerHolder(): AnswersHolder
    {
        return AnswersSerializer::deserialize($this->answers);
    }
}
