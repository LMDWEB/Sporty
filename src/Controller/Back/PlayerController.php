<?php

namespace App\Controller\Back;

use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/player")
 */
class PlayerController extends AbstractController
{
    /**
     * @Route("/", name="player_index", methods="GET")
     */
    public function index(PlayerRepository $playerRepository): Response
    {
        return $this->render('Back/player/index.html.twig', ['players' => $playerRepository->findAll()]);
    }

    /**
     * @Route("/new", name="player_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('player_index');
        }

        return $this->render('Back/player/new.html.twig', [
            'player' => $player,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_show", methods="GET")
     */
    public function show(Player $player): Response
    {
        return $this->render('Back/player/show.html.twig', ['player' => $player]);
    }

    /**
     * @Route("/{id}/edit", name="player_edit", methods="GET|POST")
     */
    public function edit(Request $request, Player $player): Response
    {
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('player_index', ['id' => $player->getId()]);
        }

        return $this->render('Back/player/edit.html.twig', [
            'player' => $player,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_delete", methods="DELETE")
     */
    public function delete(Request $request, Player $player): Response
    {
        if ($this->isCsrfTokenValid('delete'.$player->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($player);
            $em->flush();
        }

        return $this->redirectToRoute('player_index');
    }
}
