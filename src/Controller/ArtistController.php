<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artist", name="artist")
     */
    public function index(): Response
    {
        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
        ]);
    }
    /**
     * @Route("/artists", name="artist_list")
     */
    public function list(ManagerRegistry $registry): Response
    {
        return $this->render('artist/list.html.twig', [
            'controller_name' => 'ArtistController',
            'artists' => $registry->getRepository(Artist::class)->findAll(),
        ]);
    }

    /**
     * @Route("/artist/{id}", name="artist_show")
     */
    public function show(ManagerRegistry $registry, int $id): Response
    {
        return $this->render('artist/show.html.twig', [
            'controller_name' => 'ArtistController',
            'artist' => $registry->getRepository(Artist::class)->find($id),
        ]);
    }
    /**
     * @Route("/admin/artist/success", name="artist_success")
     */
    public function success(ManagerRegistry $registry): Response
    {
        return $this->render('artist/success.html.twig', [
            'controller_name' => 'ArtistController',
            'artists' => $registry->getRepository(Artist::class)->findAll(),
        ]);
    }
    /**
     * @Route("/admin/artist/create", name="artist_create")
     */
    public function create(Request $request): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artist = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();
            return $this->redirectToRoute('artist_success');
        }

        return $this->render('artist/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/artist/update/{id}", name="artist_update")
     */
    public function update(Request $request, Artist $artist): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artist = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();
            return $this->redirectToRoute('artist_success');
        }

        return $this->render('artist/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/artist/delete/{id}", name="artist_delete")
     */
    public function delete(Request $request, Artist $artist): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($artist);
        $entityManager->flush();
        return $this->redirectToRoute('artist_success');
    }
}
