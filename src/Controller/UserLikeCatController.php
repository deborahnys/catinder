<?php

namespace App\Controller;

use App\Entity\UserLikeCat;
use App\Entity\User;
use App\Entity\Cat;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserLikeCatController extends AbstractController
{
    #[Route("/favorite/{catId}", name: "add_favorite_cat")]

    public function addFavoriteCat(
        User $user,
        Request $request
    ): Response {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('login');
        }
        return $this->redirectToRoute('cats');
    }
}
