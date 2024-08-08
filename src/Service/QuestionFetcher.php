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

    public function findOneNext(int $id): ?Question
    {
        return $this->questions->findOneWithIdGreaterThan($id);
    }
}
