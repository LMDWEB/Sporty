<?php

namespace App\Controller\Back;

use App\Entity\ClubTeam;
use App\Entity\Competition;
use App\Entity\Season;
use App\Entity\SeasonCompetition;
use App\Form\SeasonCompetitionType;
use App\Form\SeasonType;
use App\Repository\SeasonRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/season")
 */
class SeasonController extends AbstractController
{
    /**
     * @Route("/", name="season_index", methods="GET")
     */
    public function index(SeasonRepository $seasonRepository): Response
    {
        return $this->render('Back/season/index.html.twig', ['seasons' => $seasonRepository->findAll()]);
    }

    /**
     * @Route("/new", name="season_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $season = new Season();
        $form = $this->createForm(SeasonType::class, $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($season);
            $em->flush();

            return $this->redirectToRoute('season_index');
        }

        return $this->render('Back/season/new.html.twig', [
            'season' => $season,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="season_show", methods="GET")
     */
    public function show(Season $season): Response
    {
        return $this->render('Back/season/show.html.twig', [
            'season' => $season
        ]);
    }

    /**
     * @Route("/{id}/edit", name="season_edit", methods="GET|POST")
     */
    public function edit(Request $request, Season $season): Response
    {
        $form = $this->createForm(SeasonType::class, $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('season_index', ['id' => $season->getId()]);
        }

        return $this->render('Back/season/edit.html.twig', [
            'season' => $season,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="season_delete", methods="DELETE")
     */
    public function delete(Request $request, Season $season): Response
    {
        if ($this->isCsrfTokenValid('delete'.$season->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($season);
            $em->flush();
        }

        return $this->redirectToRoute('season_index');
    }

    /**
     * @Route("/{season}/competition", name="season_competition_index", methods="GET")
     */
    public function indexCompetition(Season $season): Response
    {
        $seasonCompetition = $season->getSeasonCompetitions();

        return $this->render('back/season_competition/index.html.twig', [
            'season' => $season,
            'seasonCompetitions' => $seasonCompetition
        ]);
    }

    /**
     * @Route("/{season}/competition/new", name="season_competition_new", methods="GET|POST")
     */
    public function newCompetition(Request $request, Season $season): Response
    {
        $seasonCompetition = new SeasonCompetition();
        $form = $this->createForm(SeasonCompetitionType::class, $seasonCompetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $seasonCompetition->setSeason($season);
            $em->persist($seasonCompetition);
            $em->flush();

            return $this->redirectToRoute('season_competition_index', [
                'season' => $season->getId()
            ]);
        }

        return $this->render('back/season_competition/new.html.twig', [
            'seasonCompetition' => $seasonCompetition,
            'season' => $season,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{season}/competition/{id}", name="season_competition_show", methods="GET")
     */
    public function showCompetition(SeasonCompetition $seasonCompetition): Response
    {
        return $this->render('back/season_competition/show.html.twig', ['season_competition' => $seasonCompetition]);
    }

    /**
     * @Route("/{season}/competition/{id}/edit", name="season_competition_edit", methods="GET|POST")
     */
    public function editCompetition(Request $request, SeasonCompetition $seasonCompetition, Season $season): Response
    {
        $form = $this->createForm(SeasonCompetitionType::class, $seasonCompetition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $seasonCompetition->setSeason($season);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('season_competition_index', [
                'season' => $season->getId()
            ]);
        }

        return $this->render('back/season_competition/edit.html.twig', [
            'season_competition' => $seasonCompetition,
            'season' => $season,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{season}/competition/{id}", name="season_competition_delete", methods="DELETE")
     */
    public function deleteCompetition(Request $request, SeasonCompetition $seasonCompetition, Season $season): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seasonCompetition->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seasonCompetition);
            $em->flush();
        }

        return $this->redirectToRoute('season_competition_index', [
            'season' => $season
        ]);
    }

    /**
     * @Route("/{season}/competition/{id}/team", name="season_competition_team_index", methods="GET")
     */
    public function indexTeam(Season $season, SeasonCompetition $seasonCompetition): Response
    {
        $teams = $seasonCompetition->getTeams();

        return $this->render('back/season_competition_team/index.html.twig', [
            'seasoncompetition' => $seasonCompetition,
            'season' => $season,
            'teams' => $teams
        ]);
    }

    /**
     * @Route("/{season}/competition/{competition}/team/new", name="season_competition_team_new", methods="GET|POST")
     */
    public function newTeam(Request $request): Response
    {
        $seasonCompetition = new SeasonCompetition();
        $form = $this->createForm(SeasonCompetitionType::class, $seasonCompetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seasonCompetition);
            $em->flush();

            return $this->redirectToRoute('season_competition_team_index');
        }

        return $this->render('back/season_competition_team/new.html.twig', [
            'season_competition' => $seasonCompetition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{season}/competition/{competition}/team/{id}", name="season_competition_team_show", methods="GET")
     */
    public function showTeam(SeasonCompetition $seasonCompetition): Response
    {
        return $this->render('back/season_competition_team/show.html.twig', ['season_competition' => $seasonCompetition]);
    }

    /**
     * @Route("/{season}/competition/{competition}/team/{id}/edit", name="season_competition_team_edit", methods="GET|POST")
     */
    public function editTeam(Request $request, SeasonCompetition $seasonCompetition): Response
    {
        $form = $this->createForm(SeasonCompetitionType::class, $seasonCompetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('season_competition_team_index', ['id' => $seasonCompetition->getId()]);
        }

        return $this->render('back/season_competition_team/edit.html.twig', [
            'season_competition' => $seasonCompetition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{season}/competition/{competition}/team/{id}", name="season_competition_team_delete", methods="DELETE")
     */
    public function deleteTeam(Request $request, SeasonCompetition $seasonCompetition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seasonCompetition->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seasonCompetition);
            $em->flush();
        }

        return $this->redirectToRoute('season_competition_team_index');
    }

    /**
     * @Route("/{season}/team/{id}", name="season_team", methods="GET")
     */
    public function indexPlayers(Season $season, ClubTeam $clubTeam): Response
    {
        $date = explode("/", $season->getSeasonYear());
        $startContract = "07/01/" . $date["0"];
        $endContract = "06/30/" . $date["1"];

        $lastDate = new DateTime($endContract);
        $firstDate = new DateTime($startContract);

        $players = $clubTeam->getPlayerMercatos();

        return $this->render('back/season_player/index.html.twig', [
            'club' => $clubTeam,
            'season' => $season,
            'players' => $players,
            'firstYear' => $firstDate,
            'lastYear' => $lastDate
        ]);
    }
}
