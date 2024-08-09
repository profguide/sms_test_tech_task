<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Question;
use App\Repository\QuestionRepository;

final readonly class QuestionFetcher
{
    public function __construct(private QuestionRepository $questions)
    {
    }

    public function getAll(): array
    {
        return $this->questions->findAll();
    }

    public function getFirst(): Question
    {
        return $this->questions->getFirst();
    }

    public function findOneNext(int $id): ?Question
    {
        return $this->questions->findOneWithIdGreaterThan($id);
    }
}
