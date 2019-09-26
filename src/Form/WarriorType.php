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
    /**
     * @var array
     */
    private $characteristics;

    public function __construct(CharacteristicRepository $c_repo)
    {
        $this->c_repo = $c_repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $c_list = $this->c_repo->findAll();
        $builder
            ->add('Name', TextType::class)
            ->add('Victories', HiddenType::class, ['data'=>0, 'disabled'=>true])
            ->add('Defeats', HiddenType::class, ['data'=>0, 'disabled'=>true])
            ->add('FightingStyle')
            ->add('Races', EntityType::class, [
                'class' => Races::class
            ])
        ;

        foreach($c_list as $c)
        {
            $builder->add($c->getName(), IntegerType::class, ['data'=>rand($c->getMinimum(),$c->getMaximum()), 'disabled'=>true]);
        }
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
