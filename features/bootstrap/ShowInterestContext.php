<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\InterestRepository;
use App\Entity\Interest;
use App\Entity\JobSeeker;
use App\Entity\Offer;
use App\UseCase\ShowInterest;
use Assert\Assertion;
use Behat\Behat\Context\Context;

class ShowInterestContext implements Context
{
    private ShowInterest $showInterest;
    private Offer $offer;
    private JobSeeker $jobSeeker;

    /**
     * @Given /^I want to show interest for a job seeker$/
     */
    public function iWantToShowInterestForAJobSeeker()
    {
        $this->showInterest = new ShowInterest(new InterestRepository());
    }

    /**
     * @When /^I send my interest to the job seeker$/
     */
    public function iSendMyInterestToTheJobSeeker()
    {
        $this->offer = (new Offer())
            ->setName("name offer")
            ->setCompanyDescription("compagny descib")
            ->setJobDescription("job desc")
            ->setMaxSalary(72000)
            ->setMinSalary(47000)
            ->setMissions("missions")
            ->setProfile("profile")
            ->setRemote(true)
            ->setSoftSkills("soft skills")
            ->setTasks("tasks");

        $this->jobSeeker = (new JobSeeker())
            ->setPlainPassword('Coco9!X$')
            ->setEmail('email@email.com')
            ->setFirstName('John')
            ->setLastName('Doe');
    }

    /**
     * @Then /^the job seeker is aware of our interest$/
     */
    public function theJobSeekerIsAwareOfOurInterest()
    {
        Assertion::isInstanceOf($this->showInterest->execute(
            $this->offer,
            $this->jobSeeker
        ), Interest::class);
    }
}
