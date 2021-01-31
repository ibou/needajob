<?php

namespace App\Tests\Unit;

use App\Adapter\InMemory\Repository\JobSeekerRepository;
use App\Entity\JobSeeker;
use App\UseCase\RegisterJobSeeker;
use Assert\LazyAssertionException;
use PHPUnit\Framework\TestCase;

class RegisterJobSeekerTest extends TestCase
{
    /**
     * @dataProvider provideBadJobSeeker
     * @param JobSeeker $jobSeeker
     */
    public function testBadJobSeeker(JobSeeker $jobSeeker): void
    {
        $useCase = new RegisterJobSeeker(new JobSeekerRepository());
        $this->expectException(LazyAssertionException::class);
        $useCase->execute($jobSeeker);
    }

    public function testSuccessfullRegistration(): void
    {
        $useCase = new RegisterJobSeeker(new JobSeekerRepository());
        $jobSeeker = new JobSeeker();
        $jobSeeker->setPlainPassword('Samourail$');
        $jobSeeker->setEmail('email@email.com');
        $jobSeeker->setFirstName('John');
        $jobSeeker->setLastName('Doe');

        $this->assertEquals($jobSeeker, $useCase->execute($jobSeeker));
    }

    public function provideBadJobSeeker(): \Generator
    {
        yield [
            (new JobSeeker())
                ->setPlainPassword('Slsd$!-09')
                ->setEmail('email@email.com')
                ->setLastName('Doe')
            ,
        ];

        yield [
            (new JobSeeker())
                ->setPlainPassword('Slsd$!-09')
                ->setEmail('email@email.com')
                ->setFirstName('Jonhy')
            ,
        ];
        yield [
            (new JobSeeker())
                ->setPlainPassword('Slsd$!-09')
                ->setEmail('fail.com')
                ->setFirstName('Johny')
                ->setLastName('Doe')
            ,
        ];

        yield [
            (new JobSeeker())
                ->setPlainPassword('Slsd$!-09')
                ->setFirstName('Johny')
                ->setLastName('Doe')
            ,
        ];

        yield [
            (new JobSeeker())
                ->setFirstName('Johny')
                ->setLastName('Doe')
                ->setEmail('email@email.com')
            ,
        ];
        yield [
            (new JobSeeker())
                ->setPlainPassword('fail')
                ->setFirstName('Johny')
                ->setLastName('Doe')
                ->setEmail('email@email.com')
            ,
        ];

        yield [
            (new JobSeeker())
                ->setPlainPassword('')
                ->setFirstName('Johny')
                ->setLastName('Doe')
                ->setEmail('email@email.com')
            ,
        ];
    }
}
