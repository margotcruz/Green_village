<?php

namespace App\Controller;

use App\Entity\ImageProduit;
use App\Form\ImageProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/image/produit')]
final class ImageProduitController extends AbstractController
{
    #[Route(name: 'app_image_produit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $imageProduits = $entityManager
            ->getRepository(ImageProduit::class)
            ->findAll();

        return $this->render('image_produit/index.html.twig', [
            'image_produits' => $imageProduits,
        ]);
    }

    #[Route('/new', name: 'app_image_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $imageProduit = new ImageProduit();
        $form = $this->createForm(ImageProduitType::class, $imageProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($imageProduit);
            $entityManager->flush();

            return $this->redirectToRoute('app_image_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image_produit/new.html.twig', [
            'image_produit' => $imageProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_image_produit_show', methods: ['GET'])]
    public function show(ImageProduit $imageProduit): Response
    {
        return $this->render('image_produit/show.html.twig', [
            'image_produit' => $imageProduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_image_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImageProduit $imageProduit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImageProduitType::class, $imageProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_image_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image_produit/edit.html.twig', [
            'image_produit' => $imageProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_image_produit_delete', methods: ['POST'])]
    public function delete(Request $request, ImageProduit $imageProduit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imageProduit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($imageProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_image_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
