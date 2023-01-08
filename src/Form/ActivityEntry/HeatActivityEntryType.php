<?php

namespace App\Form\ActivityEntry;

use App\Entity\HeatActivityEntry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeatActivityEntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => array_flip(HeatActivityEntry::TYPES),
                'label' => 'Sélectionnez votre opération',
                'expanded' => true,
            ])
            ->add('nameOA', TextType::class, [
                'label' => 'Nom de l\'organisme agréé',
                'required' => false,
            ])
            ->add('comments', TextareaType::class, [
                'label' => 'Commentaires',
            ])
            ->add('workIdentifier', TextType::class, [
                'label' => 'Saissez votre N° de Bon de Travail',
                'required' => false,
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HeatActivityEntry::class,
        ]);
    }
}
