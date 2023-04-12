<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\User;
use App\Exception\NoUserFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */

class UserRepository extends ServiceEntityRepository
{

    public function __construct(
        private EntityManager $entityManager,
        ManagerRegistry $registry
	)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @throws NoUserFoundException
     */
    public function get(int $id): User
    {
        /** @var User|null $user */
        $user = $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if ($user === null) {
            throw NoUserFoundException::getById($id);
        }

        return $user;
    }

}
