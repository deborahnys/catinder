<?php

namespace App\Controller;

use App\Repository\ColorRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ColorType;
use App\Entity\Color;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ColorController extends AbstractController
{
    #[Route('/colors', name: 'app_colors')]
    public function index(

        ColorRepository $colorRepository,
        Request $request

    ): Response {
        return $this->render('color/index.html.twig', [
            'colors' => $colorRepository->findAll(),
        ]);
    }

    #[Route('/colors/new', name: 'app_colors_new')]
    public function new(

        Request $request,
        EntityManagerInterface $em

    ): Response {
        $form = $this->createForm(ColorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $color = $form->getData();
            $em->persist($color);
            $em->flush();

            $this->addFlash(
                'info',
                'Couleur ajoutée avec succès'
            );


            return $this->redirectToRoute('app_colors');
        }

        return $this->render('color/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/colors/edit/{id<\d+>}', name: 'app_colors_edit')]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        Color $color
    ): Response {
        $form = $this->createForm(ColorType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_colors_show', ['id' => $color->getId()]);
        }

        return $this->render('color/edit.html.twig', [
            'form' => $form,
            'colors' => $color,
        ]);
    }
}
