<?php

declare(strict_types=1);

namespace App\Test;

use App\Entity\Question;

final readonly class QuestionsHolder
{
    /**
     * @param Question[] $questions
     */
    public function __construct(private array $questions)
    {
    }

    /**
     * @return Question[]
     */
    public function getAll(): array
    {
        return $this->questions;
    }

    /**
     * @return Question[]
     */
    public function byId(): array
    {
        $questions = [];
        foreach ($this->questions as $question) {
            $questions[$question->getId()] = $question;
        }

        return $questions;
    }
}
