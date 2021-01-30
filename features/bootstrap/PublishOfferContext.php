<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\OfferRepository;
use App\Entity\Offer;
use App\UseCase\PublishOffer;
use Assert\Assertion;
use Behat\Behat\Context\Context;

class PublishOfferContext implements Context
{
    /**
      * @Given /^I want to publish an offer$/
      */
    public function iWantToPublishAnOffer()
    {
    }

    /**
     * @When /^I write the offer$/
     */
    public function iWriteTheOffer()
    {
    }

    /**
     * @Then /^the offer is published and job seeker can send their application for a new job$/
     */
    public function theOfferIsPublishedAndJobSeekerCanSendTheirApplicationForANewJob()
    {
    }
}
