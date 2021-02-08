<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\User;
use App\Entity\JobSeeker;
use App\Entity\Recruiter;
use App\Gateway\UserGateway;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository implements UserGateway
{
    private array $users = [];

    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $jobSeeker = (new JobSeeker())
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("job.seeker@email.com")
        ;

        $jobSeeker->setPassword($userPasswordEncoder->encodePassword($jobSeeker, "Password123!"));


        $recruiter = (new Recruiter())
            ->setFirstName("Jane")
            ->setLastName("Doe")
            ->setCompanyName("Company")
            ->setEmail("recruiter@email.com")
        ;

        $recruiter->setPassword($userPasswordEncoder->encodePassword($recruiter, "Password123!"));

        $this->users = [
            "job.seeker@email.com" => $jobSeeker,
            "recruiter@email.com" => $recruiter
        ];
    }

    /**
        * @inheritDoc
        */
    public function findByEmail(string $email): ?UserInterface
    {
        if (!isset($this->users[$email])) {
            throw new UsernameNotFoundException();
        }

        return $this->users[$email];
    }
}
