<?php

namespace App\Form;

use App\Entity\Warrior;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class WarriorType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('Experience')
            ->add('Strength')
            ->add('Speed')
            ->add('Dexterity')
            ->add('Constitution')
            ->add('Intelligence')
            ->add('Will')
            ->add('Coach', TextType::class,["data"=>$this->security->getUser()->getUsername(), "disabled"=>true])
            ->add('Breed')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Warrior::class,
        ]);
    }
}
