<?php

namespace App\Controller\Front;

use App\Entity\ClubTeam;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/team")
 */
class ClubController extends AbstractController
{
    /**
     * @Route("/{slug}", name="club")
     */

    public function index(ClubTeam $clubTeam, Request $request): Response
    {
        return $this->render('Front/club/index.html.twig', [
            'club' => $clubTeam
        ]);
    }
}
