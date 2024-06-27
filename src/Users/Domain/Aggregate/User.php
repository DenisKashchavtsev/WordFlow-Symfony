<?php

declare(strict_types=1);

namespace App\Users\Domain\Aggregate;

use App\Shared\Application\Event\EventBusInterface;
use App\Shared\Domain\Aggregate\Aggregate;
use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Service\UlidService;
use App\Users\Domain\Event\UserCreatedEvent;
use App\Users\Domain\Service\UserPasswordHasherInterface;

class User extends Aggregate implements AuthUserInterface
{
    private string $id;
    private string $email;
    private ?string $password;
    private string $name;

    public function __construct(string $name, string $email)
    {
        $this->id = UlidService::generate();
        $this->name = $name;
        $this->email = $email;

        $this->registerEvent(new UserCreatedEvent($this->id));
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(
        ?string                     $password,
        UserPasswordHasherInterface $passwordHasher
    ): void
    {
        if (is_null($password)) {
            $this->password = null;
        }

        $this->password = $passwordHasher->hash($this, $password);
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt(): ?string
    {
        return '';
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername(): ?string
    {
        return $this->name;
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
}