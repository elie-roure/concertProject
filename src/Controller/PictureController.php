<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Entity\Picture;
use App\Form\PictureType;
use Doctrine\Persistence\ManagerRegistry;
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
     * @Route("/admin/picture/success", name="picture_success")
     */
    public function success(ManagerRegistry $registry): Response
    {
        return $this->render('app/index.html.twig', [
            'concerts' => $registry->getRepository(Concert::class)->findFuture(),
            'enregistrement' =>true,
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

            $image = $picture->getUrl();
            $type = pathinfo($image, PATHINFO_EXTENSION);
            $data = file_get_contents($image);
            $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $picture->setUrl($dataUri);

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
