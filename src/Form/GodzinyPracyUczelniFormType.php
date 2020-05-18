<?php

namespace App\Form;

use App\Entity\GodzinyPracyUczelni;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GodzinyPracyUczelniFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day_')
            ->add('hour')
        ;
    }


}
