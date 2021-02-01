<?php

namespace App\Form;

use App\Entity\JobSeeker;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobSeekerRegistrationType extends RegistrationType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('class', JobSeeker::class);
    }
    
}
