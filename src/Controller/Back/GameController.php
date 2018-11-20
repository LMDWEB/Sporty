<?php

namespace App\Controller\Back;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="game_index", methods="GET")
     */
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('Back/game/index.html.twig', ['games' => $gameRepository->findAll()]);
    }

    /**
     * @Route("/new", name="game_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $home = $game->getTeamHome()->getName();
            $away = $game->getTeamAway()->getName();
            $name = $home . ' - ' . $away;
            $game = $game->setName($name);

            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            return $this->redirectToRoute('game_index');
        }

        return $this->render('Back/game/new.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="game_show", methods="GET")
     */
    public function show(Game $game): Response
    {
        return $this->render('Back/game/show.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/{id}/edit", name="game_edit", methods="GET|POST")
     */
    public function edit(Request $request, Game $game): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $home = $game->getTeamHome()->getName();
            $away = $game->getTeamAway()->getName();
            $name = $home . ' - ' . $away;
            $game = $game->setName($name);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('game_index', ['id' => $game->getId()]);
        }

        return $this->render('Back/game/edit.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="game_delete", methods="DELETE")
     */
    public function delete(Request $request, Game $game): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($game);
            $em->flush();
        }

        return $this->redirectToRoute('game_index');
    }

    public function list(){

        $matchday = array();

        for ($i = 1; $i < 50; $i++) {
            if ($i != 1) {
                $matchday[$i] = $i . "ème journée";
            } else {
                $matchday[$i] = $i . "ère journée";
            }
        }

        array_push(
            $matchday,
            "64ème de finale",
            "32ème de finale",
            "16ème de finale",
            "8ème de finale",
            "Quart de finale",
            "Demi finale",
            "Petite finale",
            "Finale"
        );

        return $matchday;
    }
}
