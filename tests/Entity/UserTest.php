<?php

declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Entity\User;
use App\Tests\TestCase;
use DateTimeImmutable;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserTest extends TestCase
{

    public function testStoreUser(): void
    {
        $passwordHasherFactory = new PasswordHasherFactory([
            PasswordAuthenticatedUserInterface::class => ['algorithm' => 'auto'],
        ]);
        $passwordHasher = new UserPasswordHasher($passwordHasherFactory);
        $entityManager = $this->getEntityManager();

        $user = new User();
        $hashedPassword = $passwordHasher->hashPassword($user, 'plain_password');
        $user->setEmail('johndoe@example.com');
        $user->setPassword($hashedPassword);
        $user->setCreatedAt(new DateTimeImmutable());

        $entityManager->persist($user);
        $entityManager->flush();

        self::assertEquals('johndoe@example.com', $user->getEmail());
		$foundByEmail = $this->getEntityManager()->getRepository(User::class)->findBy(['email' => 'johndoe@example.com']);

        self::assertCount(1, $foundByEmail);
    }

}
