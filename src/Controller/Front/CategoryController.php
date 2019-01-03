<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/{slug}", name="category", methods="GET")
     */

    public function index(Category $category, Request $request): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $allArticles = $this->getDoctrine()->getRepository(Article::class)->findBy(['published' => 1, 'type' => 0], ['date' => 'DESC'], 10, 0);
        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy(['published' => 1, "category" => $category], ['date' => 'DESC']);

        return $this->render('Front/category/index.html.twig', [
            'category' => $category,
            'articles' => $articles,
            'categories' => $categories,
            'allArticles' => $allArticles,
        ]);
    }
}
