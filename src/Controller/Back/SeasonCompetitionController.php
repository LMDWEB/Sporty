<?php

namespace App\Controller\Back;

use App\Entity\SeasonCompetition;
use App\Form\SeasonCompetitionType;
use App\Repository\SeasonCompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/season/competition")
 */
class SeasonCompetitionController extends AbstractController
{
    /**
     * @Route("/", name="season_competition_index", methods="GET")
     */
    public function index(SeasonCompetitionRepository $seasonCompetitionRepository): Response
    {
        return $this->render('back/season_competition/index.html.twig', ['season_competitions' => $seasonCompetitionRepository->findAll()]);
    }

    /**
     * @Route("/new", name="season_competition_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $seasonCompetition = new SeasonCompetition();
        $form = $this->createForm(SeasonCompetitionType::class, $seasonCompetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seasonCompetition);
            $em->flush();

            return $this->redirectToRoute('season_competition_index');
        }

        return $this->render('back/season_competition/new.html.twig', [
            'season_competition' => $seasonCompetition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="season_competition_show", methods="GET")
     */
    public function show(SeasonCompetition $seasonCompetition): Response
    {
        return $this->render('back/season_competition/show.html.twig', ['season_competition' => $seasonCompetition]);
    }

    /**
     * @Route("/{id}/edit", name="season_competition_edit", methods="GET|POST")
     */
    public function edit(Request $request, SeasonCompetition $seasonCompetition): Response
    {
        $form = $this->createForm(SeasonCompetitionType::class, $seasonCompetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('season_competition_index', ['id' => $seasonCompetition->getId()]);
        }

        return $this->render('back/season_competition/edit.html.twig', [
            'season_competition' => $seasonCompetition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="season_competition_delete", methods="DELETE")
     */
    public function delete(Request $request, SeasonCompetition $seasonCompetition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seasonCompetition->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seasonCompetition);
            $em->flush();
        }

        return $this->redirectToRoute('season_competition_index');
    }
}
