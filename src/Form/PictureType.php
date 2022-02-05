<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                "label"=> "Nom de l'image : ",
                'attr' => ['class' => 'form-control'],
            ])
            ->add('url', FileType::class,[
                "label"=> "Upload de l'image : ",/*
                "required" => true,
                'constraints' => [
                    new Image([
                        'maxSize' => '5000k',
                        'mimeTypesMessage' => 'Please upload a valid Iamge document',
                    ])
                ],*/
            ])
            ->add('save', SubmitType::class, [
                "label" => 'Enregister l\'image'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
