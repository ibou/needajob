<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\JobSeeker;
use App\Gateway\JobSeekerGateway;

class JobSeekerRepository extends UserRepository implements JobSeekerGateway
{
    public function register(JobSeeker $jobSeeker): void
    {
    }
}
