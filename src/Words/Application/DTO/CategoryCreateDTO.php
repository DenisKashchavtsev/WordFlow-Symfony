<?php

namespace App\Words\Application\DTO;

use App\Shared\Application\Validator\NotBlank;

class CategoryCreateDTO
{
    #[NotBlank]
    public string $name;

    #[NotBlank]
    public string $image;

    public bool $isPublic = false;
}