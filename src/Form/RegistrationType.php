<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

abstract class RegistrationType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pattern = "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/";
        $builder
            ->add('firstName', TextType::class, [
            "label" => "Prénom",
            "constraints" => [
                new NotBlank()
            ]
        ])
            ->add('lastName', TextType::class, [
            "label" => "Nom de famille",
            "constraints" => [
                new NotBlank()
            ]
        ])
            ->add('email', EmailType::class, [
            "label" => "Email",
            "constraints" => [
                new NotBlank(),
                new Email()
            ]
        ])
            ->add('plainPassword', PasswordType::class, [
            "label" => "Password",
            "constraints" => [
                new NotBlank(),
                new Regex([
                    'pattern' => $pattern
                          ])
            ]
        ])
            ;
    }

    public function getBlockPrefix()
    {
        return 'registration';
    }
}
