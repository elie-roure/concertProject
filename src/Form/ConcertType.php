<?php

namespace App\Form;

use App\Entity\Band;
use App\Entity\Concert;
use App\Entity\Picture;
use App\Entity\Venue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('capacity', NumberType::class)
            ->add('date', DateType::class,[
                "widget" => 'choice',
                "format" => 'dd / MM/ yyyy'
            ])
            ->add('name', TextType::class,[
                "label"=> "Nom du concert : "
            ])
            ->add('picture', EntityType::class, [
                "class" => Picture::class,
                "choice_label" => 'name'
            ])
            ->add('venue', EntityType::class, [
                "class" => Venue::class,
                "choice_label" => 'name'
            ])
            ->add('bands', EntityType::class, [
                "class" => Band::class,
                "multiple" => true,
                "choice_label" => 'name'
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
                "label" => 'Enregister le concert'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Concert::class,
        ]);
    }
}
