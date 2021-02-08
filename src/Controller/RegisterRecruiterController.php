<?php

namespace App\Controller;

use App\Entity\Recruiter;
use App\Form\RecruiterRegistrationType;
use App\UseCase\RegisterRecruiter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class RegisterRecruiterController
{
    private FormFactoryInterface $formFactory;
    private RegisterRecruiter $registerRecruiter;
    private UrlGeneratorInterface $urlGenerator;
    private Environment $twig;

    /**
     * RegisterRecruiterController constructor.
     * @param FormFactoryInterface $formFactory
     * @param RegisterRecruiter $registerRecruiter
     * @param UrlGeneratorInterface $urlGenerator
     * @param Environment $twig
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RegisterRecruiter $registerRecruiter,
        UrlGeneratorInterface $urlGenerator,
        Environment $twig
    ) {
        $this->formFactory = $formFactory;
        $this->registerRecruiter = $registerRecruiter;
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
    }


    public function __invoke(Request $request): Response
    {
        $recruiter = new Recruiter();
        $form = $this->formFactory->create(RecruiterRegistrationType::class, $recruiter)->handleRequest(
            $request
        );
        if ($form->isSubmitted() && $form->isValid()) {
            $this->registerRecruiter->execute($recruiter);
            return new RedirectResponse($this->urlGenerator->generate("index"));
        }

        return new Response(
            $this->twig->render(
                "ui/register_recruiter.html.twig",
                [
                    "form" => $form->createView(),
                ]
            )
        );
    }
}
