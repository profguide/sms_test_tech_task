<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionRepository::class)]
final class Option implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'options')]
    #[ORM\JoinColumn(nullable: false)]
    private ?int $question;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private ?string $text;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $isCorrect = false;

    public static function new(int $id, int $questionId, string $text, bool $isCorrect): self
    {
        $option = new self();

        $option->id = $id;
        $option->question = $questionId;
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

    public function getQuestion(): int
    {
        return $this->question;
    }

    public function setQuestion(int $question): void
    {
        $this->question = $question;
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
        ];
    }
}
