<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ResultRepository;
use App\Test\AnswersHolder;
use App\Test\AnswersSerializer;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultRepository::class)]
final class Result
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $answers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getAnswers(): string
    {
        return $this->answers;
    }

    public function setAnswers(string $answers): void
    {
        $this->answers = $answers;
    }

    public function getAnswerHolder(): AnswersHolder
    {
        return AnswersSerializer::deserialize($this->answers);
    }
}
