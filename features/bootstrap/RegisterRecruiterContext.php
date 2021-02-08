<?php

namespace App\Features;

use Assert\Assertion;
use App\Entity\Recruiter;
use Behat\Behat\Context\Context;
use App\UseCase\RegisterJobSeeker;
use App\UseCase\RegisterRecruiter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Adapter\InMemory\Repository\RecruiterRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        $userPasswordEncoder = new class () implements UserPasswordEncoderInterface {
            /**
             * @inheritDoc
             */
            public function encodePassword(UserInterface $user, string $plainPassword)
            {
                return "hash_password";
            }

            public function isPasswordValid(UserInterface $user, string $raw)
            {
            }

            public function needsRehash(UserInterface $user): bool
            {
            }
        };

        $this->registerRecruiter = new RegisterRecruiter(new RecruiterRepository($userPasswordEncoder));
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
