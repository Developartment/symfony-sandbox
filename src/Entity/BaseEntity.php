<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class BaseEntity
{

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    protected ?int $id = null;

    public function getId(): int
    {
        return $this->id;
    }

}
