<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @return Response
     *
     * @Route("/", methods={"GET"})
     */
    public function home()
    {
        return $this->render('Front/Default/home.html.twig');
    }
}