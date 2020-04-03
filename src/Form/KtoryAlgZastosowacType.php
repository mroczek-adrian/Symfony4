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
            ->add('Which_algorythm_should_i_use', ChoiceType::class, [
                'choices'  => [
                'Maybe' => null,
                'GodzinyUczelni' => true,
                'No' => false,
                ],
                ]);
        ;
    }



}
