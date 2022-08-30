<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ExampleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExampleRepository::class)]
#[ApiResource]
class Example
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'examples')]
    private ?Word $word = null;

    #[ORM\Column(length: 255)]
    private ?string $example = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Word|null
     */
    public function getWord(): ?Word
    {
        return $this->word;
    }

    /**
     * @param Word|null $word
     * @return $this
     */
    public function setWord(?Word $word): self
    {
        $this->word = $word;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExample(): ?string
    {
        return $this->example;
    }

    /**
     * @param string $example
     * @return $this
     */
    public function setExample(string $example): self
    {
        $this->example = $example;

        return $this;
    }
}
