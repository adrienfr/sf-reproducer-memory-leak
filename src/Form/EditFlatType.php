<?php

namespace App\Form;

use App\Entity\Flat;
use App\Entity\Partner;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditFlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', Type\ChoiceType::class, [
                'label' => 'Status',
                'expanded' => true,
                'choices' => [
                    'yes' => true,
                    'no' => false,
                ],
            ])
            ->add('partner', EntityType::class, [
                'class' => Partner::class,
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Partner',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flat::class,
            'cascade_validation' => true,
        ]);
    }
}
