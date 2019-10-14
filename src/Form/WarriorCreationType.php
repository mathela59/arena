<?php

namespace App\Form;

use App\Entity\FightingStyle;
use App\Entity\Races;
use App\Repository\CharacteristicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarriorCreationType extends AbstractType
{
//    private $c_repo;
//
//    public function __construct(CharacteristicRepository $c_repo)
//    {
//        $this->c_repo=$c_repo;
//    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $list = $this->c_repo->findAll();

        $builder
            ->add('Name', TextType::class)
            ->add('FightingStyle', EntityType::class, [
                'class'=>FightingStyle::class,
            ])
            ->add('Race', EntityType::class, [
                'class' => Races::class,
            ])
        ;
//        foreach ($list as $c_item)
//        {
//            $builder->add($c_item->getName(),IntegerType::class, [
//                'data'=> rand($c_item->getMinimum(),$c_item->getMaximum())
//            ]);
//        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);

    }

    public function getName()
    {
        return 'WarriorType';
    }
}
