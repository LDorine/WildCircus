<?php

namespace App\Form;

use App\Entity\Billet;
use App\Entity\Representation;
use App\Repository\RepresentationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ville = $options['ville'];

        $builder
            ->add('nom', null, [
                'label' => 'Votre nom : '
            ])
            ->add('email', null, [
                'label' => 'Votre adresse mail : '
            ])
            ->add('representations', EntityType::class, [
                'class' => Representation::class,
                'query_builder' => function (RepresentationRepository $representation) use ($ville) {
                    return $representation->findDateByVille($ville);
                },
                'choice_label' => 'date',
                'label' => 'Choissiez une représentation',
            ])
            ->add('places', CollectionType::class, [
                'label' => false,
                'entry_type' => PlaceType::class,
                'required' => false,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Billet::class,
            'ville' => 'Paris',
        ]);
    }
}
