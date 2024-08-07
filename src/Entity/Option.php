<?php

declare(strict_types=1);

namespace App\Entity;

final class Option
{
    private int $id;

    private int $questionId;

    private int $orderWeight;

    private string $text;

    private bool $isCorrect;

    public static function new(int $id, int $questionId, string $text, bool $isCorrect, int $orderWeight = 0): self
    {
        $option = new self();

        $option->id = $id;
        $option->questionId = $questionId;
        $option->orderWeight = $orderWeight;
        $option->text = $text;
        $option->isCorrect = $isCorrect;

        return $option;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function setQuestionId(int $questionId): void
    {
        $this->questionId = $questionId;
    }

    public function getOrderWeight(): int
    {
        return $this->orderWeight;
    }

    public function setOrderWeight(int $orderWeight): void
    {
        $this->orderWeight = $orderWeight;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getIsCorrect(): bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): void
    {
        $this->isCorrect = $isCorrect;
    }
}
