<?php

namespace App\Tests;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestCase extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->truncateTables();

    }
    public function getEntityManager(): EntityManager
    {
        $kernel = self::bootKernel();

        return $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
    private function truncateTables(): void
    {

        $entityManager = $this->getEntityManager();
        $purger = new ORMPurger($entityManager);
        $purger->purge();
    }
}