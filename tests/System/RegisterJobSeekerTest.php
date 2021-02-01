<?php

namespace App\Tests\System;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class RegisterJobSeekerTest
 * @package App\Tests\System
 */
class RegisterJobSeekerTest extends \App\Tests\Integration\RegisterJobSeekerTest
{
    use SystemTestTrait;
    public function testSuccessfullRegistration(): void
    {
        $client = static::createClient();
        
        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");
        
        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_job_seeker")
        );
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        $form = $crawler->filter("form[name=registration]")->form(
            [
                "registration[firstName]" => "John",
                "registration[lastName]" => "Doe",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "Password123!",
            ]
        );
        
        $client->submit($form);
        
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
    
    /**
     * @dataProvider provideBadJobSeeker
     * @param array $formdata
     * @param string $errorMessage
     */
    public function tFailRegistration(array $formdata, string $errorMessage): void
    {
        $client = static::createClient();
        
        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");
        
        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_job_seeker")
        );
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        $form = $crawler->filter("form[name=registration]")->form($formdata);
        
        $client->submit($form);
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        $this->assertSelectorTextContains("span.form-error-message", $errorMessage);
    }
    
    public function provideBadJobSeeker(): \Generator
    {
        yield [
            [
                "registration[firstName]" => "",
                "registration[lastName]" => "Doe",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "Password123!",
            ],
            "Cette valeur ne doit pas être vide.",
        ];
        
        
        yield [
            [
                "registration[firstName]" => "Joene",
                "registration[lastName]" => "",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "Password123!",
            ],
            "Cette valeur ne doit pas être vide.",
        ];
        
        yield [
            [
                "registration[firstName]" => "FAEF",
                "registration[lastName]" => "Doe",
                "registration[email]" => "emailemail.com",
                "registration[plainPassword]" => "",
            ],
            "Cette valeur n'est pas une adresse email valide.",
        ];
        
        yield [
            [
                "registration[firstName]" => "FAEF",
                "registration[lastName]" => "Doe",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "",
            ],
            "Cette valeur ne doit pas être vide.",
        ];
        
        yield [
            [
                "registration[firstName]" => "Joearh",
                "registration[lastName]" => "Doe",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "fail",
            ],
            "Cette valeur n'est pas valide.",
        ];
    }
}
