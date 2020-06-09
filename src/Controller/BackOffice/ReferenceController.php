<?php

namespace App\Controller\BackOffice;

use App\Entity\Reference;
use App\Form\ReferenceType;
use App\Repository\ReferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ReferenceController
 * @package App\Controller\BackOffice
 * @Route("/admin/references")
 */
class ReferenceController extends AbstractController
{
    /**
     * @Route(name="reference_manage")
     * @param ReferenceRepository $referenceRepository
     * @return Response
     */
    public function manage(ReferenceRepository $referenceRepository): Response
    {
        $references = $referenceRepository->findAll();

        return $this->render("back_office/reference/manage.html.twig", [
            "references" => $references
        ]);
    }

    /**
     * @Route("/create", name="reference_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $reference = new Reference();
        $form = $this->createForm(ReferenceType::class, $reference)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($reference);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La référence a été ajoutée avec succès !");

            return $this->redirectToRoute("reference_manage");
        }

        return $this->render("back_office/reference/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="reference_update")
     * @param Reference $reference
     * @param Request $request
     * @return Response
     */
    public function update(Reference $reference, Request $request): Response
    {
        $form = $this->createForm(ReferenceType::class, $reference)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La référence a été modifiée avec succès !");

            return $this->redirectToRoute("reference_manage");
        }

        return $this->render("back_office/reference/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="reference_delete")
     * @param Reference $reference
     * @return RedirectResponse
     */
    public function delete(Reference $reference): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($reference);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La référence a été supprimée avec succès !");

        return $this->redirectToRoute("reference_manage");
    }
}
