<?php

namespace App\Form;

use App\Entity\FightingStyle;
use App\Entity\Races;
use App\Entity\User;
use App\Entity\Warrior;
use App\Repository\CharacteristicRepository;
use App\Repository\FightingStyleRepository;
use App\Repository\RacesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarriorType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('Name', TextType::class)
            ->add('Victories', IntegerType::class)
            ->add('Defeats', IntegerType::class)
            ->add('FightingStyle')
            ->add('Races', EntityType::class, [
                'class' => Races::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Warrior::class,
        ]);
    }

    public function getName()
    {
        return 'WarriorType';
    }
}
