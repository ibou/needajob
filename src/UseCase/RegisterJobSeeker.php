<?php

namespace App\UseCase;

use App\Entity\JobSeeker;
use App\Gateway\JobSeekerGateway;
use Assert\Assert;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

class RegisterJobSeeker
{
    private JobSeekerGateway $jobSeekerGateway;
    private UserPasswordEncoderInterface $encoder;
    
    /**
     * RegisterJobSeeker constructor.
     * @param JobSeekerGateway $jobSeekerGateway
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(JobSeekerGateway $jobSeekerGateway, UserPasswordEncoderInterface $encoder)
    {
        $this->jobSeekerGateway = $jobSeekerGateway;
        $this->encoder = $encoder;
    }
    
    
    /**
     * @param JobSeeker $jobSeeker
     * @return JobSeeker
     */
    public function execute(JobSeeker $jobSeeker): JobSeeker
    {
        Assert::lazy()
            ->that($jobSeeker->getFirstName(), 'firstName')->notBlank()
            ->that($jobSeeker->getLastName(), 'lastName')->notBlank()
            ->that($jobSeeker->getPlainPassword(), 'plainPassword')
            ->notBlank()
            ->regex(
                "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/"
            )
            ->that($jobSeeker->getEmail(), 'email')
            ->notBlank()
            ->email()
            ->verifyNow();
     
        $jobSeeker->setPassword(
            $this->encoder->encodePassword($jobSeeker, $jobSeeker->getPlainPassword())
        );
        
        $this->jobSeekerGateway->register($jobSeeker);
        return $jobSeeker;
    }
}
