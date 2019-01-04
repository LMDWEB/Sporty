<?php

namespace App\Controller\Front;

use App\Entity\Thread;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/thread")
 */
class ThreadController extends AbstractController
{
    /**
     * @Route("/{slug}", name="category", methods="GET")
     */

    public function index(Thread $thread, Request $request): Response
    {
        return $this->render('Front/thread/index.html.twig', [
            'thread' => $thread,
        ]);
    }
}
