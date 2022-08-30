<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordRepository::class)]
#[ApiResource]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Set::class, mappedBy: 'words')]
    private Collection $sets;

    #[ORM\Column(length: 255)]
    private ?string $word = null;

    #[ORM\OneToMany(mappedBy: 'word', targetEntity: Translation::class)]
    private Collection $translations;

    #[ORM\OneToMany(mappedBy: 'word', targetEntity: Synonym::class)]
    private Collection $synonyms;

    #[ORM\OneToMany(mappedBy: 'word', targetEntity: Example::class)]
    private Collection $examples;

    public function __construct()
    {
        $this->sets = new ArrayCollection();
        $this->translations = new ArrayCollection();
        $this->synonyms = new ArrayCollection();
        $this->examples = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set
     *
     * @return Collection<int, Set>
     */
    public function getSets(): Collection
    {
        return $this->sets;
    }

    /**
     * @param Set $set
     * @return $this
     */
    public function addSet(Set $set): self
    {
        if (!$this->sets->contains($set)) {
            $this->sets->add($set);
            $set->addWord($this);
        }

        return $this;
    }

    /**
     * @param Set $set
     * @return $this
     */
    public function removeSet(Set $set): self
    {
        if ($this->sets->removeElement($set)) {
            $set->removeWord($this);
        }

        return $this;
    }


    /**
     * Word
     *
     * @return string|null
     */
    public function getWord(): ?string
    {
        return $this->word;
    }

    /**
     * @param string $word
     * @return $this
     */
    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Translate
     *
     * @return Collection<int, Translation>
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Translation $translation
     * @return $this
     */
    public function addTranslation(Translation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations->add($translation);
            $translation->setWord($this);
        }

        return $this;
    }

    /**
     * @param Translation $translation
     * @return $this
     */
    public function removeTranslation(Translation $translation): self
    {
        if ($this->translations->removeElement($translation)) {
            // set the owning side to null (unless already changed)
            if ($translation->getWord() === $this) {
                $translation->setWord(null);
            }
        }

        return $this;
    }

    /**
     * Synonym
     *
     * @return Collection<int, Synonym>
     */
    public function getSynonyms(): Collection
    {
        return $this->synonyms;
    }

    /**
     * @param Synonym $synonym
     * @return $this
     */
    public function addSynonym(Synonym $synonym): self
    {
        if (!$this->synonyms->contains($synonym)) {
            $this->synonyms->add($synonym);
            $synonym->setWord($this);
        }

        return $this;
    }

    /**
     * @param Synonym $synonym
     * @return $this
     */
    public function removeSynonym(Synonym $synonym): self
    {
        if ($this->synonyms->removeElement($synonym)) {
            // set the owning side to null (unless already changed)
            if ($synonym->getWord() === $this) {
                $synonym->setWord(null);
            }
        }

        return $this;
    }

    /**
     * Example
     *
     * @return Collection<int, Example>
     */
    public function getExamples(): Collection
    {
        return $this->examples;
    }

    /**
     * @param Example $example
     * @return $this
     */
    public function addExample(Example $example): self
    {
        if (!$this->examples->contains($example)) {
            $this->examples->add($example);
            $example->setWord($this);
        }

        return $this;
    }

    /**
     * @param Example $example
     * @return $this
     */
    public function removeExample(Example $example): self
    {
        if ($this->examples->removeElement($example)) {
            // set the owning side to null (unless already changed)
            if ($example->getWord() === $this) {
                $example->setWord(null);
            }
        }

        return $this;
    }
}
