<?php

declare(strict_types=1);

namespace App\Entity;

final readonly class Values implements \JsonSerializable
{
    /**
     * @param OptionId[] $values
     */
    public function __construct(public array $values)
    {
    }

    public function jsonSerialize(): mixed
    {
        return array_map(function (OptionId $value) {
            return $value->id;
        }, $this->values);
    }
}
