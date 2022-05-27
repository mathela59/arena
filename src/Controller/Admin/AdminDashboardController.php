<?php

namespace App\Controller\Admin;

use App\Entity\Breed;
use App\Entity\FightStyle;
use App\Entity\Items;
use App\Entity\Sentence;
use App\Entity\Skills;
use App\Entity\Slots;
use App\Entity\Traits;
use App\Entity\User;
use App\Entity\Warrior;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)
            ->generateUrl());


    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Arena Admin')
            ->setTranslationDomain('admin')
            ->setTextDirection('ltr')
            ->generateRelativeUrls(true);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa-duotone fa-home');
        yield MenuItem::section('CRUDS');
        yield MenuItem::linkToCrud('Users', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Breed', 'fa-solid fa-dragon',
            Breed::class);
        yield MenuItem::linkToCrud('FightStyle', 'fa-solid fa-gears',
            FightStyle::class);
        yield MenuItem::linkToCrud('Items', 'fa-solid fa-baseball-bat-ball',
            Items::class);
        yield MenuItem::linkToCrud('Sentences', 'fa-solid fa-edit',
            Sentence::class);
        yield MenuItem::linkToCrud('Skills', 'fa-solid fa-magic',
            Skills::class);
        yield MenuItem::linkToCrud('Slots', 'fa-brands fa-hubspot',
            Slots::class);
        yield MenuItem::linkToCrud('Traits', 'fas fa-list',
            Traits::class);
        yield MenuItem::linkToCrud('Warriors', 'fas fa-user-astronaut',
            Warrior::class);
        yield MenuItem::linkToUrl('Arena','fas fa-home',$this->generateUrl('app_homepage'));
    }

    public function configureActions(): Actions
    {

        return parent::configureActions()->add(Crud::PAGE_INDEX,
            Action::DETAIL);
    }
}
