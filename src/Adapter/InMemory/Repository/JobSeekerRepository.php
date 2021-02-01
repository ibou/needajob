<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\JobSeeker;
use App\Gateway\JobSeekerGateway;

class JobSeekerRepository implements JobSeekerGateway
{
    public function register(JobSeeker $jobSeeker): void
    {
    }
}
