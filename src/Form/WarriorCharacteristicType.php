<?php

namespace App\Form;

use App\Repository\CharacteristicRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarriorCharacteristicType extends AbstractType
{

    private $c_repo;

    public function __construct(CharacteristicRepository $c_repo)
    {
        $this->c_repo = $c_repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $list = $this->c_repo->findAll();
        foreach ($list as $c_item) {
            $builder->add($c_item->getName(), IntegerType::class, [
                'data' => rand($c_item->getMinimum(), $c_item->getMaximum())
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

    public function getName()
    {
        return 'WarriorCharacteristicType';
    }
}
