<?php

namespace App\Form;

use App\Entity\Warrior;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarriorRollType extends AbstractType
{
    public function rollDices()
    {
        $results = array();
        for ($i = 0; $i < 4; $i++) {
            $results[$i] = rand(1, 6);
        }
        //Take the 3 best dices
        return (array_sum($results) - min($results));
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Strength', IntegerType::class, ["data" => $this->rollDices()])
            ->add('Dexterity', IntegerType::class, ["data" => $this->rollDices()])
            ->add('Speed', IntegerType::class, ["data" => $this->rollDices()])
            ->add('Constitution', IntegerType::class, ["data" => $this->rollDices()])
            ->add('Intelligence', IntegerType::class, ["data" => $this->rollDices()])
            ->add('Will', IntegerType::class, ["data" => $this->rollDices()])
            ->add(
                $builder->create('buttons', FormType::class, ["label"=>"","label_attr"=>["style"=>"display:none"],"inherit_data" => true])->add('submit', SubmitType::class, ["label" => "next", "attr" => ["class" => "btn btn-primary btn-sm"]])
            ->add('reset', ResetType::class, ["label" => "Reroll", "attr" => ["class" => "btn btn-secondary btn-sm"]])
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Warrior::class,
        ]);
    }
}
