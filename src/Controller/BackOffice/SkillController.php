<?php

namespace App\Controller\BackOffice;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SkillController
 * @package App\Controller\BackOffice
 * @Route("/admin/skills")
 */
class SkillController extends AbstractController
{
    /**
     * @Route(name="skill_manage")
     * @param SkillRepository $skillRepository
     * @return Response
     */
    public function manage(SkillRepository $skillRepository): Response
    {
        $skills = $skillRepository->findAll();

        return $this->render("back_office/skill/manage.html.twig", [
            "skills" => $skills
        ]);
    }

    /**
     * @Route("/create", name="skill_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($skill);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été ajoutée avec succès !");

            return $this->redirectToRoute("skill_manage");
        }

        return $this->render("back_office/skill/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="skill_update")
     * @param Skill $skill
     * @param Request $request
     * @return Response
     */
    public function update(Skill $skill, Request $request): Response
    {
        $form = $this->createForm(SkillType::class, $skill)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été modifiée avec succès !");

            return $this->redirectToRoute("skill_manage");
        }

        return $this->render("back_office/skill/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="skill_delete")
     * @param Skill $skill
     * @return RedirectResponse
     */
    public function delete(Skill $skill): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($skill);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La compétence a été supprimée avec succès !");

        return $this->redirectToRoute("skill_manage");
    }
}
