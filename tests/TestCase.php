<?php

declare(strict_types = 1);

namespace App\Tests;

use App\Exception\LogicException;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use function array_map;
use function key;

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

        try {
            /** @var EntityManager|null $entityManager */
            $entityManager = $kernel->getContainer()
                ->get(EntityManager::class);
            if ($entityManager === null) {
                throw new LogicException('You have requested a non-existent service #' . EntityManager::class . ' ');
            }
            return $entityManager;
        } catch (ServiceNotFoundException $exception) {
            throw new LogicException($exception->getMessage());
        }
    }

    private function truncateTables(): void
    {
        $connection = $this->getEntityManager()->getConnection();
        /** @var array<int, string> $tables */
        $tables = array_map(
            static function (array $data) {
                return $data[key($data)];
            },
            $connection->fetchAllAssociative('SHOW tables;'),
        );

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            $connection->executeQuery("TRUNCATE TABLE {$table}");
            $connection->executeQuery("ALTER TABLE {$table} AUTO_INCREMENT = 1");
        }

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->getEntityManager()->close();
    }

}
