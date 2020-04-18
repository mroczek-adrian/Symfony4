<?php

namespace App\Form;

use App\Entity\Teachers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeachersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('subject')
            ->add('day1')
            ->add('day2')
            ->add('day3')
        ;
    }


}
