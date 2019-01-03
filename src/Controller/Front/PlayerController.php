<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Entity\Player;
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
     * @Route("/{slug}", name="player")
     */

    public function index(Player $player, Request $request): Response
    {
        $foot = $this->getDoctrine()->getRepository(Player::class)->footPlayer($player->getFoot());

        return $this->render('Front/player/index.html.twig', [
            'player' => $player,
            'foot' => $foot
        ]);
    }
}
