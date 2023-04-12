<?php

declare(strict_types = 1);

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[Entity(repositoryClass: UserRepository::class)]
class User extends BaseEntity implements PasswordAuthenticatedUserInterface
{

    #[Column(name: 'email', type: Types::STRING, unique: true, nullable: false)]
    private string $email;

    #[Column(name: 'first_name', type: Types::STRING, nullable: true)]
    private ?string $firstName = null;

    #[Column(name: 'last_name', type: Types::STRING, nullable: true)]
    private ?string $lastName = null;

    #[Column(name: 'password', type: Types::STRING, nullable: false)]
    private string $password;

    #[Column(name: 'created_at', type: Types::DATE_IMMUTABLE, nullable: false)]
    private DateTimeImmutable $createdAt;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}
