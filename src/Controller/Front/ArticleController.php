<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\ClubTeam;
use App\Entity\Comment;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\User;
use App\Form\CommentType;
use App\Models\Replycomment;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/news/{slug}", name="article", methods="GET|POST")
     */
    public function index(Article $article, ObjectManager $manager, Request $request): Response
    {

        // type page
        $type = $this->getDoctrine()->getRepository(Article::class)->typeArticle($article->getType());

        //new views
        $this->getDoctrine()->getRepository(Article::class)->views($article, $manager);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $ip = $request->getClientIp();
            $comment->setUser($user);
            $comment->setIdPost($article->getId());
            $comment->setNamePost($type);
            $comment->setIpAddress($ip);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        // get Player
        $players = $this->getDoctrine()->getRepository(Player::class)->findAll();
        $teams = $this->getDoctrine()->getRepository(ClubTeam::class)->findAll();
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        $allArticles = $this->getDoctrine()->getRepository(Article::class)->findBy(['published' => 1, 'type' => $article->getType()], ['date' => 'DESC'], 10, 0);
        $nextArticle = $this->getDoctrine()->getRepository(Article::class)->nextArticle($article->getDate(), $article->getType());
        $prevArticle = $this->getDoctrine()->getRepository(Article::class)->prevArticle($article->getDate(), $article->getType());

        $allComments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['id_post' => $article->getId(), 'name_post' => $type, "id_parent" => 0], ['id' => 'DESC']);
        $allReplyComments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['id_post' => $article->getId(), 'name_post' => $type], ['id' => 'DESC']);

        return $this->render('Front/article/index.html.twig', [
            'article' => $article,
            'categories' => $categories,
            'players' => $players,
            'teams' => $teams,
            'games' => $games,
            'allArticles' => $allArticles,
            'form' => $form->createView(),
            'comments' => $allComments,
            'replyComments' => $allReplyComments,
            'nextArticle' => $nextArticle,
            'prevArticle' => $prevArticle
        ]);
    }
}
