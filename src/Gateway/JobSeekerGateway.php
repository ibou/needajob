<?php

namespace App\Gateway;

use App\Entity\JobSeeker;

/**
 * Interface JobSeekerGateway
 * @package App\Gateway
 */
interface JobSeekerGateway
{
    /**
     * @param JobSeeker $jobSeeker
     */
    public function register(JobSeeker $jobSeeker): void;
}
