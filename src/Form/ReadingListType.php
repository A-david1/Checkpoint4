<?php

namespace App\Form;

use App\Entity\ReadingStatus;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReadingListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Status', ChoiceType::class, [
                'label' => 'Status :',
                'label_attr' => [
                    'class' => 'pr-2'
                ],
                'placeholder' => false,
                'choices' => [
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                    'A lire' => 'A lire'
                ]
            ])
            /*
            ->add('author', TextType::class, [
                'label' => 'Auteur :'
            ])
            ->add('status', EntityType::class, [
                'class' => ReadingStatus::class,
                'choice_label' => 'Status :'
            ])
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReadingStatus::class
        ]);
    }
}
