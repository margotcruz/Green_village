<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Form\RubriqueType;
use App\Repository\RubriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/rubrique')]
final class RubriqueController extends AbstractController
{
    #[Route(name: 'app_rubrique_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $rubriques = $entityManager
            ->getRepository(Rubrique::class)
            ->findAll();
            return $this->render('rubrique/index.html.twig', [
                'rubriques' => $rubriques,
            ]);
    }

    #[Route('/new', name: 'app_rubrique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rubrique = new Rubrique();
        $form = $this->createForm(RubriqueType::class, $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rubrique);
            $entityManager->flush();

            return $this->redirectToRoute('app_rubrique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rubrique/new.html.twig', [
            'rubrique' => $rubrique,
            'form' => $form,
        ]);
    }

//     #[Route('/{id}', name: 'app_rubrique_show', methods: ['GET'])]
// public function show(Rubrique $rubrique, RubriqueRepository $rubriqueRepository, EntityManagerInterface $entityManager): Response
// {
//     $rubriques = $entityManager->getRepository(Rubrique::class)->findAll();
//     $produits = $rubriqueRepository->ProduitParRubriques($rubrique);
    
//     return $this->render('rubrique/show.html.twig', [
//         'rubriques' => $rubriques,
//         'rubrique' => $rubrique,
//         'produits' => $produits,
//     ]);
// }

#[Route('/{id}', name: 'app_rubrique_show', methods: ['GET'])]
public function show(Rubrique $rubrique, RubriqueRepository $rubriqueRepository, EntityManagerInterface $entityManager): Response
{
    $produits = $rubriqueRepository->ProduitParRubriques($rubrique);

    $produitsAvecImages = [];
    foreach ($produits as $produit) {
        $produitId = $produit['idProduit'];
        if (!isset($produitsAvecImages[$produitId])) {
            $produitsAvecImages[$produitId] = $produit;
            $produitsAvecImages[$produitId]['images'] = [];
        }
        if ($produit['libelleImage']) {
            $produitsAvecImages[$produitId]['images'][] = $produit['libelleImage'];
        }
    }
    return $this->render('rubrique/show.html.twig', [
        'rubrique' => $rubrique,
        'produits' => array_values($produitsAvecImages), 
    ]);
}

    
    
    
    
    

    #[Route('/{id}/edit', name: 'app_rubrique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rubrique $rubrique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RubriqueType::class, $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rubrique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rubrique/edit.html.twig', [
            'rubrique' => $rubrique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rubrique_delete', methods: ['POST'])]
    public function delete(Request $request, Rubrique $rubrique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rubrique->getId(), $request->request->get('_token'))) {
            $entityManager->remove($rubrique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rubrique_index', [], Response::HTTP_SEE_OTHER);
    }
}

