<?php

namespace App\Controller\Admin;

use App\Entity\Traits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TraitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Traits::class;
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
