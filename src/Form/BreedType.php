<?php

namespace App\Form;

use App\Entity\Breed;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BreedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('Description')
            ->add('messtats',TextType::class, ["label"=>"modificateurs", "mapped"=>false, "data"=>json_encode($builder->getData()->getModifiers())]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Breed::class,
        ]);

    }
}
