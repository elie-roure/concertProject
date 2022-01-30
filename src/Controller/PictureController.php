<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PictureController extends AbstractController
{
    /**
     * @Route("/picture", name="picture")
     */
    public function index(): Response
    {
        return $this->render('picture/index.html.twig', [
            'controller_name' => 'PictureController',
        ]);
    }
    /**
     * @Route("/admin/picture/create", name="picture_create")
     */
    public function create(Request $request): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();
            return $this->redirectToRoute('picture_success');
        }

        return $this->render('picture/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/picture/update/{id}", name="picture_update")
     */
    public function update(Request $request, Picture $picture): Response
    {
        $form = $this->createForm(pictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();
            return $this->redirectToRoute('picture_success');
        }

        return $this->render('picture/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/picture/delete/{id}", name="picture_delete")
     */
    public function delete(Request $request, Picture $picture): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($picture);
        $entityManager->flush();
        return $this->redirectToRoute('picture_success');
    }
}
