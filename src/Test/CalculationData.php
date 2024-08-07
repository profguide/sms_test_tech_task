<?php

declare(strict_types=1);

namespace App\Test;

final readonly class CalculationData
{
    public function __construct(private array $data)
    {
    }

    public function get(string $key)
    {
        if (!isset($this->data[$key])) {
            throw new \InvalidArgumentException('Unknown calculation key "'.$key.'".');
        }

        return $this->data[$key];
    }
}
