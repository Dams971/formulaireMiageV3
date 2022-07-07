<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Boolean;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    // configureActions to show properties in the list view of a user
    public function configureActions(Actions $actions): Actions
    {
        return $actions -> add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    /**
    public function configureFields(string $pageName): iterable
    {
        // if admin, show only nom, prenom, email
        if ($this -> isGranted('ROLE_ADMIN')) {
            return [
                TextField::new('nom', 'Nom'),
                TextField::new('prenom', 'Prenom'),
                TextField::new('email', 'Email'),
            ];
        } else {
            return [
                TextField::new('nom'),
                TextField::new('prenom'),
                TextField::new('email'),
                TextField::new('telephone'),
                TextField::new('adresseDesParents'),
                // if the user is admin, no need to show the field
                BooleanField::new('candidaterAutresFormations', 'Candidater à d\'autres formations ?')->renderAsSwitch(false)

            ];
        }
    }
     */
}

