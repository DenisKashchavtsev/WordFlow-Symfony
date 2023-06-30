<?php

namespace App\Words\Domain\Entity;

use App\Shared\Domain\Entity\Aggregate;
use App\Shared\Domain\Service\UlidService;
use App\Words\Domain\Event\WordCreatedEvent;

class Word extends Aggregate
{
    public string $id;

    public function __construct(private readonly string $source, private readonly string $translate)
    {
        $this->id = UlidService::generate();
    }

    public static function create(string $source, string $translate): self
    {
        $word = new self($source, $translate);
        $word->raiseEvent(new WordCreatedEvent($word->id));

        return $word;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getTranslate(): string
    {
        return $this->translate;
    }

//    public function delete(): void
//    {
//        // Отправить событие об удалении категории слов
//        $this->raiseEvent(new WordCategoryDeleted($this->id));
//    }
//
//    private function raiseEvent($event): void
//    {
//        // Логика для обработки событий агрегата
//        // Например, публикация события в шине событий
//
//        // Пример публикации события в Symfony через сервис EventDispatcher:
//        // $eventDispatcher->dispatch($event);
//    }
}