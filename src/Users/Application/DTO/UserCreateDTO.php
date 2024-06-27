<?php

namespace App\Users\Application\DTO;

use App\Shared\Application\Validator\NotBlank;

class UserCreateDTO
{
    #[NotBlank]
    public string $name;

    #[NotBlank]
    public string $email;

    #[NotBlank]
    public string $password;
}