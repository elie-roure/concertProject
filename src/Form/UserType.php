<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FirstName', TextType::class,[
                "label"=> "Prenom : "
            ])
            ->add('LastName', TextType::class,[
                "label"=> "Nom : "
            ])
            ->add('email', EmailType::class, [
                "label" => "Email :",
            ])
            ->add('password', PasswordType::class, [
                "label" => "Mot de passe : ",
            ])
            ->add('save', SubmitType::class, [
                "label" => 'Modifier son compte'
            ])
        ;
        /*if ( app.user. rs_granted("ROLE_ADMIN")){
            $builder ->add('roles', ChoiceType::class,[
                'choices'  => [
                    'Admin' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER',
                ],
                'multiple' => true
            ]);
        }*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
