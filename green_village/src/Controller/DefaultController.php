<?php

namespace App\Controller;

use App\Entity\Rubrique;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $rubriques = $entityManager->getRepository(Rubrique::class)->findAll();
        $produits = $entityManager->getRepository(Produit::class)->findAll();
    
        return $this->render('index.html.twig', [
            'rubriques' => $rubriques,
            'produits' => $produits,
        ]);
    }
#[route('/test')]
    public function navbar(EntityManagerInterface $entityManager): Response
    {
        $rubriques = $entityManager->getRepository(Rubrique::class)->findAll();
        $produits = $entityManager->getRepository(Produit::class)->findAll();
        
        return $this->render('navbar.html.twig', [
            'rubriques' => $rubriques,
            'produits' => $produits,
        ]);
    }

}
