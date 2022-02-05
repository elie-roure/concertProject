<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Form\ConcertType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{
    /**
     * @Route("/admin/concert/success", name="concert_success")
     */
    public function success(ManagerRegistry $registry): Response
    {
        return $this->render('concert/list.html.twig', [
            'concerts' => $registry->getRepository(Concert::class)->findAll(),
            'title' => "Nos concerts",
            'enregistrement' =>true,
        ]);
    }
    /**
     * @Route("/concerts", name="concert_list")
     */
    public function list(ManagerRegistry $registry): Response
    {
        return $this->render('concert/list.html.twig', [
            'concerts' => $registry->getRepository(Concert::class)->findAll(),
            'title' => "Nos concerts",
        ]);
    }
    /**
     * @Route("/concerts/future", name="concertFuture_list")
     */
    public function listFuture(ManagerRegistry $registry): Response
    {
        return $this->render('concert/list.html.twig', [
            'concerts' => $registry->getRepository(Concert::class)->findFuture(),
            'title' => "Nos future concerts",
        ]);
    }
    /**
     * @Route("/concert/past", name="concertPast_list")
     */
    public function listPast(ManagerRegistry $registry): Response
    {
        return $this->render('concert/list.html.twig', [
            'concerts' => $registry->getRepository(Concert::class)->findPast(),
            'title' => "Nos précédent concerts",
        ]);
    }
    /**
     * @Route("/concert/{id}", name="concert_show")
     */
    public function show(ManagerRegistry $registry, int $id): Response
    {
        return $this->render('concert/show.html.twig', [
            'concert' => $registry->getRepository(Concert::class)->find($id),
        ]);
    }

    /**
     * @Route("/admin/concert/create", name="concert_create")
     */
    public function create(Request $request): Response
    {
        $concert = new Concert();
        $form = $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();
            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concert/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/concert/update/{id}", name="concert_update")
     */
    public function update(Request $request, Concert $concert): Response
    {
        $form = $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();
            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concert/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/concert/delete/{id}", name="concert_delete")
     */
    public function delete(Request $request, Concert $concert): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();
        return $this->redirectToRoute('concert_success');
    }
}
