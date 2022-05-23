<?php

namespace App\Form;

use App\Entity\Warrior;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarriorOtherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FightStyle')
            ->add('Breed')
            ->add(
                $builder->create('buttons', FormType::class, ["label"=>"","label_attr"=>["style"=>"display:none"],"inherit_data" => true])->add('submit', SubmitType::class, ["label" => "next", "attr" => ["class" => "btn btn-primary btn-sm"]]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Warrior::class,
        ]);
    }
}
