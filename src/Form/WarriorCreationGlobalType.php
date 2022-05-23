<?php

namespace App\Form;

use App\Entity\Warrior;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class WarriorCreationGlobalType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["label_attr"=>["class"=>"form-label"]])
            ->add('description', TextareaType::class,["label_attr"=>["class"=>'form-label']])
            ->add('Experience', HiddenType::class, ["data"=>0])
            ->add(
                $builder->create('buttons',
                    FormType::class, [
                        "label"=>"",
                        "label_attr"=>["style"=>"display:none"],
                        "inherit_data" => true
                    ])
                    ->add('submit',
                        SubmitType::class, [
                            "label" => "next",
                            "attr" => [
                                "class" => "btn btn-primary btn-sm",
                                ]
                        ]));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Warrior::class,
        ]);
    }
}
