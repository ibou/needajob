<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class RegisterRecruiterTest extends WebTestCase
{
    public function testSuccessfullRegistration(): void
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_recruiter")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=registration]")->form(
            [
                "registration[firstName]" => "John",
                "registration[lastName]" => "Doe",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "Password123!",
                "registration[companyName]" => "Oil Ltd Techn!",
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
    public function testFailRegistration(array $formdata, string $errorMessage): void
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_recruiter")
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
                "registration[companyName]" => "JFEAB LS",
            ],
            "Cette valeur ne doit pas être vide.",
        ];


        yield [
            [
                "registration[firstName]" => "Joene",
                "registration[lastName]" => "",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "Password123!",
                "registration[companyName]" => "JFEAB LS",
            ],
            "Cette valeur ne doit pas être vide.",
        ];

        yield [
            [
                "registration[firstName]" => "FAEF",
                "registration[lastName]" => "Doe",
                "registration[email]" => "emailemail.com",
                "registration[plainPassword]" => "",
                "registration[companyName]" => "JFEAB LS",
            ],
            "Cette valeur n'est pas une adresse email valide.",
        ];

        yield [
            [
                "registration[firstName]" => "FAEF",
                "registration[lastName]" => "Doe",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "",
                "registration[companyName]" => "JFEAB LS",
            ],
            "Cette valeur ne doit pas être vide.",
        ];

        yield [
            [
                "registration[firstName]" => "Joearh",
                "registration[lastName]" => "Doe",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "fail",
                "registration[companyName]" => "JFEAB LS",
            ],
            "Cette valeur n'est pas valide.",
        ];


        yield [
            [
                "registration[companyName]" => "",
                "registration[firstName]" => "Joearh",
                "registration[lastName]" => "Doe",
                "registration[email]" => "email@email.com",
                "registration[plainPassword]" => "PaswordD!9",
            ],
            "Cette valeur ne doit pas être vide.",
        ];
    }
}
