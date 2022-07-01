<?php

namespace App\Controller\Admin;

use App\Entity\Formulaires;
use App\Entity\Questions;
use App\Entity\User;
use App\Repository\FormulairesRepository;
use App\Repository\QuestionsRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var FormulairesRepository
     */
    protected FormulairesRepository $formulairesRepository;

    /**
     * @var QuestionsRepository
     */
    protected QuestionsRepository $questionsRepository;

    public function __construct(
        UserRepository $userRepository,
        FormulairesRepository $formulairesRepository,
        QuestionsRepository $questionsRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->formulairesRepository = $formulairesRepository;
        $this->questionsRepository = $questionsRepository;
    }

    public function createEntity(string $entityFqcn)
    {
        $formulaire = new Formulaires;
        $formulaire-> setTitle('Formulaire');
    }


    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(): Response
    {
        return $this -> render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllUser' => $this->userRepository->countAllUser(),
            'countAllFormulaires' => $this->formulairesRepository->countAllFormulaires()

        ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('bundles/easyadmin/css/style.css');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FormulaireMiage');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Formulaires', 'fas fa-list', Formulaires::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Questions', 'fas fa-list', Questions::class);

    }

    /**
     * @return UserRepository
     */
    public function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    /**
     * @param UserRepository $userRepository
     */
    public function setUserRepository(UserRepository $userRepository): void
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return FormulairesRepository
     */
    public function getFormulairesRepository(): FormulairesRepository
    {
        return $this->formulairesRepository;
    }

    /**
     * @param FormulairesRepository $formulairesRepository
     */
    public function setFormulairesRepository(FormulairesRepository $formulairesRepository): void
    {
        $this->formulairesRepository = $formulairesRepository;
    }
}
