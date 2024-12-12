<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Form\ProduitType;
use App\Entity\ImageProduit;
use App\Repository\RubriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/produit')]
final class ProduitController extends AbstractController
{


#[Route(name: 'app_produit_index', methods: ['GET'])]
public function index(Request $request, RubriqueRepository $rubriqueRepository, EntityManagerInterface $entityManager): Response
{
    $rubriques = $entityManager->getRepository(Rubrique::class)->findAll();

    $marque = $request->query->get('marque');
    $rubriqueParentId = $request->query->get('rubriqueParent');
    $rubriqueId = $request->query->get('rubrique');

    $produitsParRubrique = [];

    foreach ($rubriques as $rubrique) {
        $produitsAvecSousRubrique = $rubriqueRepository->ProduitParRubriques(
            $rubrique,
            $marque,
            $rubriqueParentId,
            $rubriqueId
        );
       

        $produitsAvecSousRubrique = $this->removeDuplicates($produitsAvecSousRubrique);
        

        $produitsParRubrique[$rubrique->getId()] = $produitsAvecSousRubrique;
    }

    return $this->render('produit/index.html.twig', [
        'rubriques' => $rubriques,
        'produitsParRubrique' => $produitsParRubrique,
        'marque' => $marque,
        'rubriqueParentId' => $rubriqueParentId,
        'rubriqueId' => $rubriqueId
    ]);
}


private function removeDuplicates(array $produits): array
{
    $seen = [];
    $uniqueProduits = [];

    foreach ($produits as $produit) {
        if (!in_array($produit['idProduit'], $seen)) {
            $seen[] = $produit['idProduit'];
            $uniqueProduits[] = $produit;
        }
    }

    return $uniqueProduits;
}


    




    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }


    

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {   
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'images' => $produit->getImages(),
            
        ]);
    }
    

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
