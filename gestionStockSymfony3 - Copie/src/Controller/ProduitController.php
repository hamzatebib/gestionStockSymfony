<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/listeP", name="listeproduit")
     */
    public function index(): Response
    {
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        return $this->render(
            'produit/listeP.html.twig',
            [
                'produits' => $produits
            ]
        );
    }
    /**
     * @Route("/produit/new", name="produit_new")
     * @param Request $request
     * @return Response
     */

    public function newp(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('listeproduit');
        }
        return $this->render('produit/new.html.twig', [
            "form" => $form->createView()
        ]);
    }
    /**
     * @Route("/modify-produit/{id}", name="modify_produit")
     */
    public function modifyproduit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $produit = $entityManager->getRepository(Produit::class)->find($id);
        $form = $this->createForm(produitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('listeproduit');
        }

        return $this->render("produit/update.html.twig", [

            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/produit/{id}/delete", name="produit_delete")
     * @param Produit $produit
     * @return RedirectResponse
     */
    public function delete(Produit $produit): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute("listeproduit");
    }
    /**
     * @Route("/{id}/show", name="produit_show")
     * @param produit $produit
     * @return Response
     */
    public function show(Produit $produit): Response
    {
        return $this->render("produit/show.html.twig", [
            "produit" => $produit
        ]);
    }
}
