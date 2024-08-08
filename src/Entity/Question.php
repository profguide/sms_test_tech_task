<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
final class Question implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private ?string $text;

    /**
     * @var ArrayCollection<Option>
     */
    #[ORM\OneToMany(targetEntity: Option::class, mappedBy: 'questionId')]
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
     * @return ArrayCollection<Option>
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'options' => $this->options->getValues(),
        ];
    }
}
