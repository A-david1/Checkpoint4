<?php

namespace App\Form;

use App\Entity\ReadingStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddReadingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('book', BookType::class, [
                'label' => false,
            ])
            ->add('Status', ChoiceType::class, [
                'label' => 'Status :',
                'label_attr' => [
                    'class' => 'pr-2 font-regular'
                ],
                'placeholder' => false,
                'choices' => [
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                    'A lire' => 'A lire'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReadingStatus::class,
        ]);
    }
}
