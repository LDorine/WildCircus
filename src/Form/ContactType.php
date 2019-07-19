<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'label' => 'Entrez votre nom :',
            ])
            ->add('mail', null, [
                'label' => 'Entrez votre adresse  :',
            ])
            ->add('sujet', ChoiceType::class, [
                'choice' => [
                    'Informations' => 'informations',
                    'Questions' => 'questions',
                    'Réservations groupe' => 'groupe',
                ],
                'label' => 'Choissiez un sujet :',
            ])
            ->add('commentaire', null, [
                'label' => 'Votre message : ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
