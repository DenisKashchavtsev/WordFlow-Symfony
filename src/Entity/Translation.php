<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TranslationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TranslationsRepository::class)]
#[ApiResource]
class Translation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'translations')]
    private ?Word $word = null;

    #[ORM\Column(length: 255)]
    private ?string $translate = null;

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
    public function getTranslate(): ?string
    {
        return $this->translate;
    }

    /**
     * @param string $translate
     * @return $this
     */
    public function setTranslate(string $translate): self
    {
        $this->translate = $translate;

        return $this;
    }
}
