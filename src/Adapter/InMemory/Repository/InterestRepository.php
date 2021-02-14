<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Interest;
use App\Gateway\InterestGateway;

class InterestRepository implements InterestGateway
{
    /**
     * @inheritDoc
     */
    public function send(Interest $interest): void
    {
    }
}
