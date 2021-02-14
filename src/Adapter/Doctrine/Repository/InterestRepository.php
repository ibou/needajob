<?php

namespace App\Adapter\Doctrine\Repository;

use App\Entity\Interest;
use App\Gateway\InterestGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InterestRepository extends ServiceEntityRepository implements InterestGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Interest::class);
    }

    /**
     * @inheritDoc
     */
    public function send(Interest $interest): void
    {
    }
}
