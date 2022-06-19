<?php

namespace App\Controller\Admin;

use App\Entity\TypeEvent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeEvent::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function ConfigureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les types d\'évènements')
            ->setEntityLabelInSingular('un type d\'évènement')
            ->setPageTitle("index", "Les types d'évènements");
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm()->hideOnDetail(),
            TextField::new('name', 'Intitulé'),
            TextareaField::new('description'),
            BooleanField::new('is_active', 'Activé / Désactivé'),
            BooleanField::new('is_obligated', 'Visibilité obligatoire')
        ];
    }

}
