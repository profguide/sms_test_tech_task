<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Result;
use App\Repository\ResultRepository;

final readonly class ResultService
{
    public function __construct(private ResultRepository $results)
    {
    }

    public function create(Result $result): void
    {
        $this->results->create($result);
    }

    public function findOneById(int $id): ?Result
    {
        return $this->results->find($id);
    }
}
