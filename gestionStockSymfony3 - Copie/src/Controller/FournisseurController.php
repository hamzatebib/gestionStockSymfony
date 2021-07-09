<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FournisseurController extends AbstractController
{
    /**
     * @Route("/listeF", name="listeFournisseur")
     */
    public function index(): Response
    {
        $fournisseurs = $this->getDoctrine()->getRepository(Fournisseur::class)->findAll();
        return $this->render(
            'fournisseur/listeF.html.twig',
            [
                'fournisseurs' => $fournisseurs
            ]
        );
    }



    /**
     * @Route("/fournisseur/new", name="fournisseur_new")
     * @param Request $request
     * @return Response
     */

    public function newf(Request $request): Response
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($fournisseur);
            $em->flush();

            return $this->redirectToRoute('listeFournisseur');
        }
        return $this->render('fournisseur/new.html.twig', [
            "form" => $form->createView()
        ]);
    }
    /**
     * @Route("/modify-fournisseur/{id}", name="modify_fournisseur")
     */
    public function modifyfournisseur(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $fournisseur = $entityManager->getRepository(Fournisseur::class)->find($id);
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('listeFournisseur');
        }

        return $this->render("fournisseur/update.html.twig", [

            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/fournisseur/{id}/delete", name="fournisseur_delete")
     * @param fournisseur $fournisseur
     * @return RedirectResponse
     */
    public function delete(Fournisseur $fournisseur): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($fournisseur);
        $em->flush();

        return $this->redirectToRoute("listeFournisseur");
    }
    /**
     * @Route("/{id}/show", name="fournisseur_show")
     * @param fournisseur $fournisseur
     * @return Response
     */
    public function show(Fournisseur $fournisseur): Response
    {
        return $this->render("fournisseur/show.html.twig", [
            "fournisseur" => $fournisseur
        ]);
    }
}
