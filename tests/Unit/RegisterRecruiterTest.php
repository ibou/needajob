<?php

namespace App\Tests\Unit;

use App\Adapter\InMemory\Repository\RecruiterRepository;
use App\Entity\Recruiter;
use App\UseCase\RegisterRecruiter;
use Assert\LazyAssertionException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterRecruiterTest extends TestCase
{
    /**
     * @dataProvider provideBadRecruiter
     * @param Recruiter $recruiter
     */
    public function testBadRecruiter(Recruiter $recruiter): void
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);

        $userPasswordEncoder->method('encodePassword')->willReturn('hast_password');

        $useCase = new RegisterRecruiter(new RecruiterRepository($userPasswordEncoder));


        $this->expectException(LazyAssertionException::class);
        $useCase->execute($recruiter);
    }

    public function testSuccessfullRegistration(): void
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);

        $userPasswordEncoder->method('encodePassword')->willReturn('hast_password');
        $useCase = new RegisterRecruiter(new RecruiterRepository($userPasswordEncoder));

        $recruiter = new Recruiter();
        $recruiter->setPlainPassword('Samourail$');
        $recruiter->setEmail('email@email.com');
        $recruiter->setFirstName('John');
        $recruiter->setLastName('Doe');
        $recruiter->setCompanyName('P - Ouil');

        $this->assertEquals($recruiter, $useCase->execute($recruiter));
    }

    /**
     * @return \Generator
     */
    public function provideBadRecruiter(): \Generator
    {
        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("email@email.com")
                ->setPlainPassword("Password123!")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("email@email.com")
                ->setPlainPassword("Password123!")
                ->setCompanyName("")
        ];

        yield [
            (new Recruiter())
                ->setLastName("Doe")
                ->setEmail("email@email.com")
                ->setPlainPassword("Password123!")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("")
                ->setLastName("Doe")
                ->setEmail("email@email.com")
                ->setPlainPassword("Password123!")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setEmail("email@email.com")
                ->setPlainPassword("Password123!")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("")
                ->setEmail("email@email.com")
                ->setPlainPassword("Password123!")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setPlainPassword("Password123!")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("")
                ->setPlainPassword("Password123!")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("fail")
                ->setPlainPassword("Password123!")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("email@email.com")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("email@email.com")
                ->setPlainPassword("")
                ->setCompanyName("Company")
        ];

        yield [
            (new Recruiter())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("email@email.com")
                ->setPlainPassword("fail")
                ->setCompanyName("Company")
        ];
    }
}
