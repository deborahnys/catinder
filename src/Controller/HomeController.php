<?php

namespace App\Controller;

use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function indexOrShowSingleCat(CatRepository $catRepository): Response
    {
        $user = $this->getUser();

        if ($user) {
            $notLinkedCats = $catRepository->findNotLinkedCatsByUser($user);
            if (empty($notLinkedCats)) {
                throw $this->createNotFoundException('No more cats available');
            }
            $cat = $notLinkedCats[array_rand($notLinkedCats)];
            return $this->render('home/index.html.twig', [
                'cat' => $cat,
            ]);
        }

        return $this->redirectToRoute('app_login');
    }
}
