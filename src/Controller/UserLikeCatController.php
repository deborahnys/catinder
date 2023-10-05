<?php

namespace App\Controller;

use App\Entity\UserLikeCat;
use App\Entity\Cat;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserLikeCatController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/like_cat/{catId}', name: 'like_cat', methods: ['POST'])]
    public function likeCat(int $catId, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'User not logged in!']);
        }

        $cat = $entityManager->getRepository(Cat::class)->find($catId);

        if (!$cat) {
            return new JsonResponse(['success' => false, 'message' => 'Cat not found!']);
        }

        $existingLike = $entityManager->getRepository(UserLikeCat::class)->findOneBy([
            'user' => $user,
            'cat' => $cat
        ]);
        if ($existingLike) {
            return new JsonResponse(['success' => false, 'message' => 'You already liked this cat!']);
        }

        $userLikeCat = new UserLikeCat();
        $userLikeCat->setUser($user);
        $userLikeCat->setCat($cat);
        $userLikeCat->setIsLiked(true);

        $entityManager->persist($userLikeCat);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => 'Cat liked!']);
    }
}
