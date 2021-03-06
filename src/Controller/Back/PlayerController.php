<?php

namespace App\Controller\Back;

use App\Entity\Player;
use App\Entity\PlayerMercato;
use App\Form\PlayerMercatoType;
use App\Form\PlayerType;
use App\Entity\Season;
use App\Repository\PlayerRepository;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/list/{page<\d+>?1}", name="player_index", methods="GET")
     */
    public function index(PlayerRepository $repo, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Player::class);
        $pagination->setCurrentPage($page);
        $pagination->setLimit(50);

        return $this->render('Back/player/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="player_new", methods="GET|POST")
     */
    public function new(Request $request, ObjectManager $manager): Response
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($player->getPlayerMercatos() as $playerMercato){
                $playerMercato->setPlayer($player);
                $manager->persist($playerMercato);
            }

            $manager->persist($player);
            $manager->flush();

            $this->addFlash('success' , 'Le joueur a bien été ajouté !');

            return $this->redirectToRoute('player_index');
        }

        return $this->render('Back/player/new.html.twig', [
            'player' => $player,
            'form' => $form->createView()
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
    public function edit(Request $request, Player $player, ObjectManager $manager): Response
    {

        $form = $this->createForm(PlayerType::class, $player);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($player->getPlayerMercatos() as $playerMercato) {

                $season = $this->getDoctrine()->getRepository(PlayerMercato::class)->getSeason($playerMercato->getDate());
                $season_year = $this->getDoctrine()->getRepository(Season::class)->findBy(['season_year' => $season]);

                $playerMercato->setPlayer($player);
                $playerMercato->setSeason($season_year[0]);
                $manager->persist($playerMercato);
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success' , 'Le joueur a bien été mise à jour !');

            return $this->redirectToRoute('player_index', ['id' => $player->getId()]);
        }

        return $this->render('Back/player/edit.html.twig', [
            'player' => $player,
            'form' => $form->createView()
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

            $this->addFlash('success' , 'Le joueur a bien été supprimé !');
        }

        return $this->redirectToRoute('player_index');
    }
}
