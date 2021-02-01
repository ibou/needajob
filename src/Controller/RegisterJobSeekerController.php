<?php

namespace App\Controller;

use App\Entity\JobSeeker;
use App\Form\JobSeekerRegistrationType;
use App\UseCase\RegisterJobSeeker;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class RegisterJobSeekerController
{
    private FormFactoryInterface $formFactory;
    private RegisterJobSeeker $registerJobSeeker;
    private UrlGeneratorInterface $urlGenerator;
    private Environment $twig;

    /**
     * RegisterJobSeekerController constructor.
     * @param FormFactoryInterface $formFactory
     * @param RegisterJobSeeker $registerJobSeeker
     * @param UrlGeneratorInterface $urlGenerator
     * @param Environment $twig
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RegisterJobSeeker $registerJobSeeker,
        UrlGeneratorInterface $urlGenerator,
        Environment $twig
    ) {
        $this->formFactory = $formFactory;
        $this->registerJobSeeker = $registerJobSeeker;
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
    }


    public function __invoke(Request $request): Response
    {
        $jobSeeker = new JobSeeker();
        $form = $this->formFactory->create(JobSeekerRegistrationType::class, $jobSeeker)->handleRequest(
            $request
        );
        if ($form->isSubmitted() && $form->isValid()) {
            $this->registerJobSeeker->execute($jobSeeker);

            return new RedirectResponse($this->urlGenerator->generate("index"));
        }

        return new Response(
            $this->twig->render(
                "ui/register_job_seeker.html.twig",
                [
                    "form" => $form->createView(),
                ]
            )
        );
    }
}
