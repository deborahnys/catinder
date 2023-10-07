<?php

namespace App\Controller;

use App\Entity\Cat;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(

        Request $request,
        CatRepository $catRepository,
        UserInterface $user = null
    ): Response {
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        $cats = $catRepository->findNotLinkedCatsByUser($user);

        return $this->render('home/index.html.twig', [
            'cats' => $cats,
        ]);
    }
}
