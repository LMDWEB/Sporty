<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Entity\Player;
use App\Entity\Team;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PaginationService;
/**
 * @Route("/player")
 */
class PlayerController extends AbstractController
{
    /**
     * @Route("/{slug}/{id}", name="player")
     */

    public function page(Player $player, Request $request): Response
    {
        $foot = $this->getDoctrine()->getRepository(Player::class)->footPlayer($player->getFoot());

        return $this->render('Front/player/index.html.twig', [
            'player' => $player,
            'foot' => $foot
        ]);
    }

    /**
     * @Route("/{page<\d+>?1}", name="player_front")
     */
    public function index(PlayerRepository $playerRepository, $page, PaginationService $pagination, Request $request): Response
    {
        $pagination->setEntityClass(Player::class);
        $pagination->setCurrentPage($page);
        $pagination->setLimit(40);

        return $this->render('Front/player/list.html.twig', [
            'players' => $pagination
        ]);
    }
}
