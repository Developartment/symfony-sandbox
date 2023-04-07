<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

abstract class BaseEntity
{

    #[Id]
    #[GeneratedValue]
    #[Column]
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

}
