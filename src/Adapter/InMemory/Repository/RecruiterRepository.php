<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Recruiter;
use App\Gateway\RecruiterGateway;

class RecruiterRepository implements RecruiterGateway
{
    public function register(Recruiter $recruiter): void
    {
    }
}
