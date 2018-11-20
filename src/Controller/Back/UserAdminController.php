<?php

namespace App\Controller\Back;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserAdminController extends AbstractController
{
    /**
     * @Route("/", name="user_index")
     */
    public function index(UserRepository $manager)
    {
        return $this->render('Back/user/index.html.twig', [
            'users' => $manager->findAll(),
        ]);
    }
}
