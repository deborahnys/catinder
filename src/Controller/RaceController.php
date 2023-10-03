<?php

namespace App\Controller;

use App\Repository\RaceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RaceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaceController extends AbstractController
{
    #[Route('/races', name: 'app_races')]
    public function index(

        RaceRepository $raceRepository,
        Request $request

    ): Response {
        return $this->render('race/index.html.twig', [
            'races' => $raceRepository->findAll(),
        ]);
    }

    #[Route('/races/new', name: 'app_races_new')]
    public function new(

        Request $request,
        EntityManagerInterface $em

    ): Response {
        $form = $this->createForm(RaceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $race = $form->getData();
            $em->persist($race);
            $em->flush();

            $this->addFlash(
                'info',
                'Race ajoutée avec succès'
            );


            return $this->redirectToRoute('app_races');
        }

        return $this->render('race/new.html.twig', [
            'form' => $form,
        ]);
    }
}
