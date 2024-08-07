<?php

declare(strict_types=1);

namespace App\Test;

use App\Entity\Answer;

final readonly class AnswersHolder implements \JsonSerializable
{
    /**
     * @param Answer[] $answers
     */
    public function __construct(private array $answers)
    {
    }

    /**
     * @return Answer[]
     */
    public function getAll(): array
    {
        return $this->answers;
    }

    public function jsonSerialize(): array
    {
        return $this->answers;
    }
}
