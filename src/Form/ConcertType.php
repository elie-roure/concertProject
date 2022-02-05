<?php

namespace App\Form;

use App\Entity\Band;
use App\Entity\Concert;
use App\Entity\Picture;
use App\Entity\Place;
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
            ->add('name', TextType::class,[
                "label"=> "Nom du concert : "
            ])
            ->add('capacity', NumberType::class,[
                "label"=> "Nombre de place disponible : "
            ])
            ->add('date', DateType::class,[
                "label"=> "Date du concert : ",
                "widget" => 'choice',
                "format" => 'ddMMMMyyyy'
            ])
            ->add('bands', EntityType::class, [
                "label"=> "Groupes représentés : ",
                "class" => Band::class,
                "multiple" => true,
                "choice_label" => 'name'
            ])
            ->add('venue', EntityType::class, [
                "label"=> "Salle de représentation : ",
                "class" => Venue::class,
                "choice_label" => 'name',
                'group_by' => 'place.name',
            ])
            ->add('picture', EntityType::class, [
                "label" => "Image",
                "class" => Picture::class,
                "choice_label" => 'name'
            ])
            ->add('save', SubmitType::class, [
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
