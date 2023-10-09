<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\CatRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CatType;
use App\Entity\Cat;
use App\Entity\UserLikeCat;
use App\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CatController extends AbstractController
{
    #[Route('/cats', name: 'app_cat')]
    public function index(

        CatRepository $catRepository,
        Request $request

    ): Response {
        return $this->render('cat/index.html.twig', [
            'cats' => $catRepository->findAll(),
        ]);
    }

    #[Route('/cats/new', name: 'app_cats_new')]
    public function new(

        Request $request,
        EntityManagerInterface $em

    ): Response {
        $form = $this->createForm(CatType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cat = $form->getData();
            $em->persist($cat);
            $em->flush();

            $this->addFlash(
                'info',
                'Chat ajouté avec succès'
            );


            return $this->redirectToRoute('app_cats');
        }

        return $this->render('cat/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/cats/edit/{id<\d+>}', name: 'app_cats_edit')]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        Cat $cat
    ): Response {
        $form = $this->createForm(CatType::class, $cat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_cats_show', ['id' => $cat->getId()]);
        }

        return $this->render('cat/edit.html.twig', [
            'form' => $form,
            'cats' => $cat,
        ]);
    }

    #[Route('/get_next_cat', name: 'get_next_cat', methods: ['GET'])]
    public function getNextCat(CatRepository $catRepository): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['error' => 'User not authenticated'], 401);
        }

        $notLinkedCats = $catRepository->findNotLinkedCatsByUser($user);

        if (empty($notLinkedCats)) {
            return $this->json(['error' => 'No more cats available'], 404);
        }

        $cat = $notLinkedCats[array_rand($notLinkedCats)];

        return $this->json([
            'id' => $cat->getId(),
            'name' => $cat->getName(),
            'race' => $cat->getRace()->getTitle(),
            'age' => $cat->getAge(),
            'localisation' => $cat->getLocalisation(),
            'picture' => $cat->getPicture(),
        ]);
    }
}
