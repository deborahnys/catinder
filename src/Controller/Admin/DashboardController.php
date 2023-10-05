<?php

namespace App\Controller\Admin;

use App\Controller\CatController;
use App\Entity\Cat;
use App\Entity\Color;
use App\Entity\Race;
use App\Entity\User;
use App\Entity\UserLikeCat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CatCrudController::class)->generateUrl());
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Catinder');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Cats', 'fas fa-cat', Cat::class);
        yield MenuItem::linkToCrud('Race', 'fas fa-tags', Race::class);
        yield MenuItem::linkToCrud('Color', 'fas fa-palette', Color::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('UserLikeCat', 'fas fa-heart', UserLikeCat::class);
    }
}
