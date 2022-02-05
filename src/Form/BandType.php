<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Band;
use App\Entity\Picture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                "label"=> "Nom du groupe : "
            ])
            ->add('style', TextType::class,[
                "label"=> "Style du groupe : "
            ])
            ->add('artists', EntityType::class, [
                "label" => "Artistes du groupe :",
                "class" => Artist::class,
                "multiple" => true,
                "choice_label" => 'name'
            ])
            ->add('picture', EntityType::class, [
                "label" => "Image",
                "class" => Picture::class,
                "choice_label" => 'name'
            ])


            ->add('save', SubmitType::class, [
                "label" => 'Enregister le groupe'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Band::class,
        ]);
    }
}
