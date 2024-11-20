<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DetailLivraisonController extends AbstractController
{
    #[Route('/detail/livraison', name: 'app_detail_livraison')]
    public function index(): Response
    {
        return $this->render('detail_livraison/index.html.twig', [
            'controller_name' => 'DetailLivraisonController',
        ]);
    }
}
