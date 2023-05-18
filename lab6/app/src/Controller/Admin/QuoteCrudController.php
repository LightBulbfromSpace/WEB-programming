<?php

namespace App\Controller\Admin;

use App\Entity\Quote;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuoteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quote::class;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToCrud('Answers', 'fa-duotone fa-quotes', Quote::class);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderSidebarMinimized()
            ->setEntityLabelInSingular('Quote')
            ->setEntityLabelInPlural('Quotes')
            ->setEntityPermission('ROLE_ADMIN')
            ->setDefaultSort(['id' => 'ASC', 'historian' => 'ASC', 'year' => 'DESC'])
            ->setPageTitle('index', '%entity_label_plural% listing')
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(2);
    }

    public function CreateEntity(string $entityFqcn)
    {
        return new Quote('New Quote', 'New Historian', '0000');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('quote'),
            TextField::new('historian'),
            IntegerField::new('year'),
        ];
    }
}
