<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchGlobalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('query', SearchType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Rechercher',
                    'class' => 'font-medium font-regular',
                ]])
            ->add('type', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Général' => 'general',
                    'Auteur' => 'author',
                    'Sujet' => 'subject',
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => false,
                'label_attr' => [
                    'class' => 'navbar-label d-flex justify-content-center font-medium font-regular 
                    text-uppercase p-2 mt-1'
                ],
                'attr' => [
                    'class' => 'navbar-radio font-regular'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
