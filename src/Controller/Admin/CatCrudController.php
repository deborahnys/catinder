<?php

namespace App\Controller\Admin;

use App\Entity\Cat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CatCrudController extends AbstractCrudController
{
    use Traits\ReadTrait;
    public static function getEntityFqcn(): string
    {
        return Cat::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextField::new('race'),
            IntegerField::new('age'),
            TextField::new('color'),
            TextField::new('localisation'),

        ];
    }
}
