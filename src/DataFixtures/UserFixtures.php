<?php

namespace App\DataFixtures;

use App\Entity\JobSeeker;
use App\Entity\Recruiter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $jobSeeker = (new JobSeeker())
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("job.seeker@email.com")
        ;

        $jobSeeker->setPassword($this->userPasswordEncoder->encodePassword($jobSeeker, "Password123!"));
        $manager->persist($jobSeeker);

        $recruiter = (new Recruiter())
            ->setFirstName("Jane")
            ->setLastName("Doe")
            ->setCompanyName("Company")
            ->setEmail("recruiter@email.com")
        ;

        $recruiter->setPassword($this->userPasswordEncoder->encodePassword($recruiter, "Password123!"));

        $manager->persist($recruiter);

        $manager->flush();
    }
}
