<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

final class Question
{
    private int $id;

    private string $text;

    private ArrayCollection $options;

    public static function new(int $id, string $text, ArrayCollection $options): self
    {
        $question = new Question();
        $question->id = $id;
        $question->text = $text;
        $question->options = $options;

        return $question;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return ArrayCollection[Option]
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }
}
