<?php

namespace App\Controller\BackOffice;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FormationController
 * @package App\Controller\BackOffice
 * @Route("/admin/formations")
 */
class FormationController extends AbstractController
{
    /**
     * @Route(name="formation_manage")
     * @param FormationRepository $formationRepository
     * @return Response
     */
    public function manage(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();

        return $this->render("back_office/formation/manage.html.twig", [
            "formations" => $formations
        ]);
    }

    /**
     * @Route("/create", name="formation_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($formation);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La formation a été ajoutée avec succès !");

            return $this->redirectToRoute("formation_manage");
        }

        return $this->render("back_office/formation/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="formation_update")
     * @param Formation $formation
     * @param Request $request
     * @return Response
     */
    public function update(Formation $formation, Request $request): Response
    {
        $form = $this->createForm(FormationType::class, $formation)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La formation a été modifiée avec succès !");

            return $this->redirectToRoute("formation_manage");
        }

        return $this->render("back_office/formation/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="formation_delete")
     * @param Formation $formation
     * @return RedirectResponse
     */
    public function delete(Formation $formation): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($formation);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La formation a été supprimée avec succès !");

        return $this->redirectToRoute("formation_manage");
    }
}
