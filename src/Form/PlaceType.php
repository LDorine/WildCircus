<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emplacement', ChoiceType::class, [
                'label' => 'Choisie la catégorie',
                'choices' => [
                    'Loges' => 'Loges',
                    'Première' => 'Première',
                    'Seconde' => 'Seconde',
                ],
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Choisie le tarif ',
                'choices' => [
                    'Adulte' => 'adulte',
                    'Enfant' => 'enfant',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
