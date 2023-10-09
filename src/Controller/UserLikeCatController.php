<?php

namespace App\Controller;

use App\Entity\UserLikeCat;
use App\Entity\Cat;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;


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

    #[Route('/dislike_cat/{catId}', name: 'dislike_cat', methods: ['POST'])]
    public function dislikeCat(int $catId, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'User not logged in!']);
        }

        $cat = $entityManager->getRepository(Cat::class)->find($catId);

        if (!$cat) {
            return new JsonResponse(['success' => false, 'message' => 'Cat not found!']);
        }

        $existingDislike = $entityManager->getRepository(UserLikeCat::class)->findOneBy([
            'user' => $user,
            'cat' => $cat
        ]);
        if ($existingDislike) {
            return new JsonResponse(['success' => false, 'message' => 'You already disliked this cat!']);
        }

        $userLikeCat = new UserLikeCat();
        $userLikeCat->setUser($user);
        $userLikeCat->setCat($cat);
        $userLikeCat->setIsLiked(false);

        $entityManager->persist($userLikeCat);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => 'Cat disliked!']);
    }

    #[Route('/favorites', name: 'favorites', methods: ['GET'])]
    public function favorites(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'User not logged in!']);
        }

        $favoriteCats = [];
        $userLikeCats = $entityManager->getRepository(UserLikeCat::class)->findBy([
            'user' => $user,
            'is_liked' => true,
        ]);

        foreach ($userLikeCats as $userLikeCat) {
            $favoriteCats[] = $userLikeCat->getCat();
        }

        // Vous pouvez maintenant retourner la liste des chats en favoris à votre template Twig
        return $this->render('user_like_cat/favorites.html.twig', [
            'favoriteCats' => $favoriteCats,
        ]);
    }
}
