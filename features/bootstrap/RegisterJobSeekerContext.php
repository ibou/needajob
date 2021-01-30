<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\JobSeekerRepository;
use App\Entity\JobSeeker;
use App\UseCase\RegisterJobSeeker;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class RegisterJobSeekerContext
 * @package App\Features
 */
class RegisterJobSeekerContext implements Context
{


    /**
     * @Given /^I need to register to look for a new job$/
     */
    public function iNeedToRegisterToLookForANewJob()
    {
    }

    /**
     *
     * @When /^I fill the registration form$/
     */
    public function iFillTheRegistrationForm()
    {
    }

    /**
     * @Then /^I can log in with my new account$/
     */
    public function iCanLogInWithMyNewAccount()
    {
    }
}
