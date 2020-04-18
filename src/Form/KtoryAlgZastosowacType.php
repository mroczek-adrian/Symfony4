<?php

namespace App\Form;

use App\Entity\KtoryAlgZastosowac;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class KtoryAlgZastosowacType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('nazwa_algorytmu')
            ->add('Do_you_want_to_use_algorithm', ChoiceType::class, [
                'choices'  => [

                'Yes' => true,
                'No' => false,
                ],
                ]);
        ;
    }



}
