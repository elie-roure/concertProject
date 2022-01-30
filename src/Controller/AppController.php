<?php

namespace App\Controller;

use App\Entity\Concert;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ManagerRegistry $registry): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'ConcertController',
            'concerts' => $registry->getRepository(Concert::class)->findFuture(),
        ]);
    }
}
