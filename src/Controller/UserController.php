<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/user/{id}", name="user_show")
     */
    public function show(ManagerRegistry $registry, int $id): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $registry->getRepository(User::class)->find($id),
        ]);
    }
    /**
     * @Route("/admin/user", name="user_list")
     */
    public function list(ManagerRegistry $registry): Response
    {
        return $this->render('user/list.html.twig', [
            'users' => $registry->getRepository(User::class)->findAll(),
        ]);
    }
    /**
     * @Route("/profile/user/update/{id}", name="user_update")
     */
    public function update(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/profile/user/delete/{id}", name="user_delete")
     */
    public function delete(Request $request, User $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirectToRoute('accueil', ['enregistrement' => true]);
    }
}
