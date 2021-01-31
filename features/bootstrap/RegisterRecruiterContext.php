<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\RecruiterRepository;
use App\Entity\Recruiter;
use App\UseCase\RegisterJobSeeker;
use App\UseCase\RegisterRecruiter;
use Assert\Assertion;
use Behat\Behat\Context\Context;

/**
 * Class RegisterRecruiterContext
 * @package App\Features
 */
class RegisterRecruiterContext implements Context
{
    private RegisterRecruiter $registerRecruiter;

    private Recruiter $recruiter;

    /**
     * @Given /^I need to register to recruit new employees$/
     */
    public function iNeedToRegisterToRecruitNewEmployees()
    {
        $this->registerRecruiter = new RegisterRecruiter(new RecruiterRepository());
    }

    /**
     *
     * @When /^I fill the registration form$/
     */
    public function iFillTheRegistrationForm()
    {
        $this->recruiter = new Recruiter();
        $this->recruiter->setPlainPassword('Coco9!X$');
        $this->recruiter->setEmail('email@email.com');
        $this->recruiter->setFirstName('John');
        $this->recruiter->setLastName('Doe');
        $this->recruiter->setCompanyName('Web leaser');
    }

    /**
     * @Then /^I can log in with my new account$/
     */
    public function iCanLogInWithMyNewAccount()
    {
        Assertion::eq($this->recruiter, $this->registerRecruiter->execute($this->recruiter));
    }
}
