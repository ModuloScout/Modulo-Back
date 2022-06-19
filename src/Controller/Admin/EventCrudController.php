<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function ConfigureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les évènements')
            ->setEntityLabelInSingular('un évènement')
            ->setPageTitle("index", "Les évènements");
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);


    }

    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id')->hideOnIndex()->hideOnForm()->hideOnDetail(),
            TextField::new('title', 'Intitulé'),
            AssociationField::new('typeEvent', 'Le type d\'évènement'),
            DateTimeField::new('dateStart', 'Date et heure de début')->setFormat('dd.MM.yyyy à HH:mm'),
            DateTimeField::new('dateEnd', 'Date et heure de fin')->setFormat('dd.MM.yyyy à HH:mm'),
            TextEditorField::new('description', 'Description'),
            AssociationField::new('concernedStructure', 'Structures concernées')->hideOnIndex(),
            AssociationField::new('concernedRole', 'Invitation par fonction')->hideOnIndex(),
            AssociationField::new('concernedUser', 'Invitation nominative')->hideOnIndex(),
            BooleanField::new('isActive', 'Activé / Désactivé'),

        ];
    }

}
