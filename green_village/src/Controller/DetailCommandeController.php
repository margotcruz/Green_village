<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DetailCommandeController extends AbstractController
{
    #[Route('/detail/commande', name: 'app_detail_commande')]
    public function index(): Response
    {
        return $this->render('detail_commande/index.html.twig', [
            'controller_name' => 'DetailCommandeController',
        ]);
    }
}
