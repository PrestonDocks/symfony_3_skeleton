<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

class editUserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('plainPassword',RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'The password fields must match',
                'options'=>['attr'=>['class'=>'password-field']],
                'required'=>true,
                'first_options'=>['label'=>'Password'],
                'second_options'=>['label'=>'Confirm Password']
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('mobileNumber')
            ->add('phoneNumber');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>User::class,

        ]);
    }

    public function getBlockPrefix()
    {
        return 'user_bundleregister_form';
    }
}
