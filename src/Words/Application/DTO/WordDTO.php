<?php

namespace App\Words\Application\DTO;

use App\Words\Domain\Aggregate\Word;

class WordDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $source,
        public readonly string $translate)
    {
    }

    public static function fromEntity(Word $word): WordDTO
    {
        return new self($word->getId(), $word->getSource(), $word->getTranslate());
    }

}