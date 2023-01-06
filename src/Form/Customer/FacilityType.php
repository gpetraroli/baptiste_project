<?php

namespace App\Form\Customer;

use App\Entity\Facility;
use App\Entity\HeatActivity;
use App\Form\Address\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FacilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('address', AddressType::class, [
                'label' => 'Facility address'
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Facility type',
                'choices' => Facility::FACILITY_TYPES,
            ])
            ->add('publicMessageFr', TextareaType::class)
            ->add('publicMessageEn', TextareaType::class)
            ->add('heatActivities', CollectionType::class, [
                'entry_type' => HeatActivityType::class,
            ])
            ->add('submit', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facility::class,
        ]);
    }
}
