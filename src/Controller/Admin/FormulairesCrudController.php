<?php

namespace App\Controller\Admin;

use App\Entity\Formulaires;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormulairesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formulaires::class;
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
