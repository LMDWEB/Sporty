<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Entity\MenuItem;
use App\Entity\Partnership;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Entity\Menu;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends AbstractController
{
    /**
     * @return Response
     *
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function home(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user, array('action' => $this->generateUrl('user_register')));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre compte a bien été créé ! Vous pouvez maintenant vous connecter'
            );
            return $this->redirectToRoute('homepage');
        }

        $articleRepo = $this->getDoctrine()->getRepository(Article::class);
        $partnerRepo = $this->getDoctrine()->getRepository(Partnership::class);

        $featured = $articleRepo->findBy(['featured' => 1, 'published' => 1, 'type' => 0], ['date' => 'DESC'], 3, 0);
        $lastestNews = $articleRepo->findBy(['published' => 1, 'type' => 0], ['date' => 'DESC'], 6, 0);
        $mercatoNews = $articleRepo->findBy(['published' => 1, 'category' => 1, 'type' => 0], ['date' => 'DESC'], 6, 0);
        $partners = $partnerRepo->findBy([]);

        return $this->render('Front/Default/home.html.twig', [
            'form' => $form->createView(),
            'featured' => $featured,
            'lastestNews' => $lastestNews,
            'mercatoNews' => $mercatoNews,
            'partners' => $partners
        ]);
    }

    public function menu()
    {
        $leftMenu = $this->getDoctrine()->getRepository(Menu::class)->findBy(["published" => 1, "name" => "menu left"]);
        $parentMenuLeft = $this->getDoctrine()->getRepository(MenuItem::class)->findBy(["parent" => $leftMenu[0]->getId(), "subParent" => false]);

        $rightMenu = $this->getDoctrine()->getRepository(Menu::class)->findBy(["published" => 1, "name" => "menu right"]);
        $parentMenuRight = $this->getDoctrine()->getRepository(MenuItem::class)->findBy(["parent" => $rightMenu[0]->getId(), "subParent" => false]);

        $menus = $this->getDoctrine()->getRepository(MenuItem::class)->findBy(["parent" => $leftMenu[0]->getId(), "subParent" => 1]);


        return $this->render('Front/include/_menu.html.twig', [
            'parentMenusLeft' => $parentMenuLeft,
            'parentMenusRight' => $parentMenuRight,
            'menus' => $menus,
        ]);
    }

    public function footer()
    {
        return $this->render('Front/include/_footer.html.twig', [
        ]);
    }
}