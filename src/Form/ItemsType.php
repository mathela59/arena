<?php

namespace App\Form;

use App\Entity\Items;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('Description')
            ->add('modifiers',TextType::class, ["label"=>"modificateurs", "mapped"=>false, "data"=>json_encode($builder->getData()->getModifiers())])
            ->add('requirements',TextType::class, ["label"=>"requirements", "mapped"=>false, "data"=>json_encode($builder->getData()->getRequirements())])
            ->add('Slot');

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Items::class,
        ]);
    }
}
