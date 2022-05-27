<?php

namespace App\Controller\Admin;

use App\Entity\Warrior;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WarriorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Warrior::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
