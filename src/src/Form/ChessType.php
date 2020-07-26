<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_x', TextType::class,["label" => "Startovní pozice x (písmeno a-h) "])
            ->add('start_y', TextType::class,["label" => "Konečná pozice Y (číslo 1-8) "])
            ->add("end_x", TextType::class,["label" => "Startovní pozice x (písmeno a-h) "])
            ->add("end_y", TextType::class,["label" => "Konečná pozice Y (číslo 1-8) "])
            ->add("save",SubmitType::class,["label" => "Vyhodnotit"])
        ;
    }
}
