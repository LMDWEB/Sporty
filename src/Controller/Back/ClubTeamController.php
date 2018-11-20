<?php

namespace App\Controller\Back;

use App\Entity\ClubTeam;
use App\Form\ClubTeamType;
use App\Repository\ClubTeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/club_team")
 */
class ClubTeamController extends AbstractController
{
    /**
     * @Route("/", name="club_team_index", methods="GET")
     */
    public function index(ClubTeamRepository $clubTeamRepository): Response
    {
        return $this->render('back/club_team/index.html.twig', ['club_teams' => $clubTeamRepository->findAll()]);
    }

    /**
     * @Route("/new", name="club_team_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $clubTeam = new ClubTeam();
        $form = $this->createForm(ClubTeamType::class, $clubTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $club = $clubTeam->getClub()->getName();
            $team = $clubTeam->getTeam()->getName();
            $team = ($team == "A") ? "" : $team;
            $name = $club . ' ' . $team;
            $clubTeam = $clubTeam->setName($name);

            $em = $this->getDoctrine()->getManager();
            $em->persist($clubTeam);
            $em->flush();

            return $this->redirectToRoute('club_team_index');
        }

        return $this->render('back/club_team/new.html.twig', [
            'club_team' => $clubTeam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="club_team_show", methods="GET")
     */
    public function show(ClubTeam $clubTeam): Response
    {
        return $this->render('back/club_team/show.html.twig', ['club_team' => $clubTeam]);
    }

    /**
     * @Route("/{id}/edit", name="club_team_edit", methods="GET|POST")
     */
    public function edit(Request $request, ClubTeam $clubTeam): Response
    {
        $form = $this->createForm(ClubTeamType::class, $clubTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $club = $clubTeam->getClub()->getName();
            $team = $clubTeam->getTeam()->getName();
            $team = ($team == "A") ? "" : $team;

            $name = $club . ' ' . $team;
            $clubTeam = $clubTeam->setName($name);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('club_team_index', ['id' => $clubTeam->getId()]);
        }

        return $this->render('back/club_team/edit.html.twig', [
            'club_team' => $clubTeam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="club_team_delete", methods="DELETE")
     */
    public function delete(Request $request, ClubTeam $clubTeam): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clubTeam->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clubTeam);
            $em->flush();
        }

        return $this->redirectToRoute('club_team_index');
    }
}
