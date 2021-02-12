<?php

namespace App\Tests\Integration;

use App\Tests\AuthenticationTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class PublishOfferTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testSuccessfullRegistration(): void
    {
        $client = static::createAuthenticatedClient('recruiter@email.com');

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("publish_offer")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=offer]")->form(
            [
                "offer[name]" => "name",
                "offer[companyDescription]" => "Carson Ville",
                "offer[jobDescription]" => "A new Job",
                "offer[missions]" => "Do a surf",
                "offer[profile]" => "profile",
                "offer[softSkills]" => "skills",
                "offer[tasks]" => "tasks",
                "offer[minSalary]" => 2000,
                "offer[maxSalary]" => 3000,
                "offer[remote]" => true,
            ]
        );

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * @dataProvider provideBadJobSeeker
     * @param array $formdata
     * @param string $errorMessage
     */
    public function testFailRegistration(array $formdata, string $errorMessage): void
    {
        $client = static::createAuthenticatedClient('recruiter@email.com');

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("publish_offer")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=offer]")->form($formdata);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorTextContains("span.form-error-message", $errorMessage);
    }

    public function provideBadJobSeeker(): \Generator
    {
        yield [
            [
                "offer[companyDescription]" => "Carson Ville",
                "offer[jobDescription]" => "A new Job",
                "offer[missions]" => "Do a surf",
                "offer[profile]" => "profile",
                "offer[softSkills]" => "skills",
                "offer[tasks]" => "tasks",
                "offer[minSalary]" => 2000,
                "offer[maxSalary]" => 3000,
                "offer[remote]" => true,
            ],
            "Cette valeur ne doit pas être vide.",
        ];
        yield [
            [
                "offer[name]" => "name",
                "offer[companyDescription]" => "Carson Ville",
                "offer[jobDescription]" => "A new Job",
                "offer[profile]" => "profile",
                "offer[softSkills]" => "skills",
                "offer[tasks]" => "tasks",
                "offer[minSalary]" => 2000,
                "offer[maxSalary]" => 3000,
                "offer[remote]" => true,
            ],
            "Cette valeur ne doit pas être vide.",
        ];
        yield [
            [
                "offer[name]" => "name",
                "offer[companyDescription]" => "Carson Ville",
                "offer[jobDescription]" => "A new Job",
                "offer[missions]" => "Do a surf",
                "offer[profile]" => "profile",
                "offer[softSkills]" => "skills",
                "offer[minSalary]" => 2000,
                "offer[maxSalary]" => 3000,
                "offer[remote]" => true,
            ],
            "Cette valeur ne doit pas être vide.",
        ];

        yield [
            [
                "offer[name]" => "Carson Ville",
                "offer[companyDescription]" => "Carson Ville",
                "offer[jobDescription]" => "A new Job",
                "offer[missions]" => "Do a surf",
                "offer[profile]" => "profile",
                "offer[softSkills]" => "skills",
                "offer[minSalary]" => 2000,
                "offer[maxSalary]" => 3000,
                "offer[remote]" => true,
            ],
            "Cette valeur ne doit pas être vide.",
        ];

        yield [
            [
                "offer[companyDescription]" => "Carson Ville",
                "offer[jobDescription]" => "A new Job",
                "offer[missions]" => "Do a surf",
                "offer[profile]" => "profile",
                "offer[softSkills]" => "skills",
                "offer[tasks]" => "tasks",
                "offer[maxSalary]" => 3000,
                "offer[remote]" => true,
            ],
            "Cette valeur ne doit pas être vide.",
        ];
    }
}
