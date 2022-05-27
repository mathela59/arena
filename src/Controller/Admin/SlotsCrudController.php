<?php

namespace App\Controller\Admin;

use App\Entity\Slots;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SlotsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slots::class;
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
