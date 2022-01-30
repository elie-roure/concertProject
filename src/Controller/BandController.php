<?php

namespace App\Controller;

use App\Entity\Band;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BandController extends AbstractController
{
    /**
     * @Route("/band", name="band")
     */
    public function index(): Response
    {
        return $this->render('band/index.html.twig', [
            'controller_name' => 'BandController',
        ]);
    }
    /**
     * @Route("/admin/band/success", name="band_success")
     */
    public function success(ManagerRegistry $registry): Response
    {
        return $this->render('band/success.html.twig', [
            'controller_name' => 'BandController',
            'bands' => $registry->getRepository(Band::class)->findAll(),
        ]);
    }
    /**
     * @Route("/bands", name="band_list")
     */
    public function list(ManagerRegistry $registry): Response
    {
        return $this->render('band/list.html.twig', [
            'controller_name' => 'BandController',
            'bands' => $registry->getRepository(Band::class)->findAll(),
        ]);
    }
    /**
     * @Route("/band/{id}", name="band_show")
     */
    public function show(ManagerRegistry $registry, int $id): Response
    {
        return $this->render('band/show.html.twig', [
            'controller_name' => 'BandController',
            'band' => $registry->getRepository(Band::class)->find($id),
        ]);
    }

    /**
     * @Route("/admin/band/create", name="band_create")
     */
    public function create(Request $request): Response
    {
        $band = new Band();
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $band = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($band);
            $entityManager->flush();
            return $this->redirectToRoute('band_success');
        }

        return $this->render('band/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/band/update/{id}", name="band_update")
     */
    public function update(Request $request, Band $band): Response
    {
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $band = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($band);
            $entityManager->flush();
            return $this->redirectToRoute('band_success');
        }

        return $this->render('band/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/band/delete/{id}", name="band_delete")
     */
    public function delete(Request $request, Band $band): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($band);
        $entityManager->flush();
        return $this->redirectToRoute('band_success');
    }
}
