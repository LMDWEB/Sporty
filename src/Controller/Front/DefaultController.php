<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Configuration;
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
    public function home()
    {

        $articleRepo = $this->getDoctrine()->getRepository(Article::class);
        $categoryRepo = $this->getDoctrine()->getRepository(Category::class);
        $partnerRepo = $this->getDoctrine()->getRepository(Partnership::class);

        $mercato = $categoryRepo->findOneBy(['name' => "Transferts"]);
        $video = $categoryRepo->findOneBy(['name' => "Videos"]);
        $dossier = $categoryRepo->findOneBy(['name' => "Dossiers"]);

        $featured = $articleRepo->findBy(['featured' => 1, 'published' => 1, 'type' => 0], ['date' => 'DESC'], 3, 0);
        $lastestNews = $articleRepo->findBy(['published' => 1, 'type' => 0], ['date' => 'DESC'], 6, 0);
        $mercatoNews = $articleRepo->findBy(['published' => 1, 'category' => $mercato, 'type' => 0], ['date' => 'DESC'], 6, 0);
        $partners = $partnerRepo->findAll();

        return $this->render('Front/Default/home.html.twig', [
            'featured' => $featured,
            'lastestNews' => $lastestNews,
            'mercatoNews' => $mercatoNews,
            'partners' => $partners,
            'dossier' => $dossier,
            'video' => $video,
        ]);
    }

    public function menu()
    {
        $menuRep = $this->getDoctrine()->getRepository(Menu::class);
        $menuItemRep = $this->getDoctrine()->getRepository(MenuItem::class);
        $leftMenu = $menuRep->findBy(["published" => 1, "name" => "menu left"]);
        $parentMenuLeft = $menuItemRep->findBy(["parent" => $leftMenu[0]->getId(), "subParent" => false]);

        $articleRepo = $this->getDoctrine()->getRepository(Article::class);
        $news = $articleRepo->findBy(['published' => 1, 'type' => 0], ['date' => 'DESC'], 6, 0);

        $rightMenu = $menuRep->findBy(["published" => 1, "name" => "menu right"]);
        $parentMenuRight = $menuItemRep->findBy(["parent" => $rightMenu[0]->getId(), "subParent" => false]);
        $menus = $menuItemRep->findBy(["parent" => $leftMenu[0]->getId(), "subParent" => 1]);

        $logo = $this->getDoctrine()->getRepository(Configuration::class)->config("logo");

        return $this->render('Front/include/_menu.html.twig', [
            'parentMenusLeft' => $parentMenuLeft,
            'parentMenusRight' => $parentMenuRight,
            'menus' => $menus,
            'logo' => $logo,
            'news' => $news
        ]);
    }

    public function head()
    {
        $site = $this->getDoctrine()->getRepository(Configuration::class)->config("namesite");
        $description = $this->getDoctrine()->getRepository(Configuration::class)->config("description");
        $favicon = $this->getDoctrine()->getRepository(Configuration::class)->config("favicon");
        $twitter = $this->getDoctrine()->getRepository(Configuration::class)->config("twitter");

        return $this->render('Front/include/_head.html.twig', [
            'name' => $site,
            'description' => $description,
            'favicon' => $favicon,
            'twitter' => $twitter,
        ]);
    }

    public function game()
    {
        $site = $this->getDoctrine()->getRepository(Configuration::class)->config("namesite");

        return $this->render('Front/include/_game.html.twig', [
            'name' => $site,
        ]);
    }

    public function timer()
    {
        $site = $this->getDoctrine()->getRepository(Configuration::class)->config("namesite");

        return $this->render('Front/include/_timer.html.twig', [
            'name' => $site,
        ]);
    }

    public function footer(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
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

        $site = $this->getDoctrine()->getRepository(Configuration::class)->config("namesite");


        return $this->render('Front/include/_footer.html.twig', [
            'name' => $site,
            'form' => $form->createView(),
        ]);
    }
}