<?php

namespace App\UseCase;

use App\Entity\Interest;
use App\Entity\JobSeeker;
use App\Entity\Offer;
use App\Gateway\InterestGateway;

class ShowInterest
{
    private InterestGateway $interestGateway;

    /**
     * ShowInterest constructor.
     *
     * @param InterestGateway $interestGateway
     */
    public function __construct(InterestGateway $interestGateway)
    {
        $this->interestGateway = $interestGateway;
    }


    public function execute(Offer $offer, JobSeeker $jobSeeker): Interest
    {
        $interest = (new Interest())
            ->setOffer($offer)
            ->setJobSeeker($jobSeeker);
        $this->interestGateway->send($interest);
        return $interest;
    }
}
