<?php

namespace App\Form;

use App\Entity\Warrior;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarriorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('description', TextareaType::class,["label_attr"=>["class"=>"form-label"]])
            ->add('Experience', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('Strength', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('Speed', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('Dexterity', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('Constitution', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('Intelligence', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('Will', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('victories', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('loss', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('Coach', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('FightStyle', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('Breed', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
            ->add('skills', null,['attr'=>['disabled'=>'disabled'],"label_attr"=>["class"=>"form-label"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Warrior::class,
        ]);
    }
}
