<?php

namespace App\Controller;

use App\Entity\Rubrique;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FragmentController extends AbstractController
{
    
    public function rubriques(EntityManagerInterface $entityManager): Response
    {
        $rubriques = $entityManager->getRepository(Rubrique::class)->findAll();
    
        return $this->render('navbar.html.twig', [
            'rubriques' => $rubriques,
        ]);
    }
}
