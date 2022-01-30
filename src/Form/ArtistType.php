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

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                "label"=> "Nom de l'artiste : "
            ])
            ->add('scene_name', TextType::class,[
                "label"=> "Nom de scene de l'artiste : "
            ])
            ->add('picture', EntityType::class,[
                "class" => Picture::class,
                "label" => "Img : ",
                "choice_label" => 'name'
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
                "label" => 'Enregister l\'artiste'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
