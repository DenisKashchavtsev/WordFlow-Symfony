<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SynonymRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SynonymRepository::class)]
#[ApiResource]
class Synonym
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'synonyms')]
    private ?Word $word = null;

    #[ORM\Column(length: 255)]
    private ?string $synonym = null;

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
    public function getSynonym(): ?string
    {
        return $this->synonym;
    }

    /**
     * @param string $synonym
     * @return $this
     */
    public function setSynonym(string $synonym): self
    {
        $this->synonym = $synonym;

        return $this;
    }
}
