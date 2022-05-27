<?php

namespace App\Controller\Admin;

use App\Entity\Sentence;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SentenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sentence::class;
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
