<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'app_user')]
    public function index(

        UserRepository $userRepository,
        Request $request

    ): Response {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    #[Route('/users/new', name: 'app_users_new')]
    public function new(

        Request $request,
        EntityManagerInterface $em

    ): Response {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'info',
                'avec'
            );


            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form,
        ]);
    }
}
