<?php

namespace App\Form;

use App\Entity\WarriorCharacteristic;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Core\DataTransformer\StringToFloatTransformerTest;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarriorCharacteristicEmbeddedFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Value')
            ->add('carac', StringType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WarriorCharacteristic::class,
        ]);
    }
}
