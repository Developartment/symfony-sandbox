<?php

declare(strict_types = 1);

namespace Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{

    public function testSetAndGetEmail(): void
    {
        $user = new User();
        $user->setEmail('johndoe@example.com');
        self::assertEquals('johndoe@example.com', $user->getEmail());
    }

}
