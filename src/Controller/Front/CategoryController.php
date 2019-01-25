<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Entity\Category;
use App\Service\PaginationService;
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
     * @Route("/{slug}/{page<\d+>?1}", name="category", methods="GET")
     */

    public function index(Category $category, Request $request, $page, PaginationService $pagination): Response
    {

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        $pagination->setEntityClass(Article::class)->getData(['published' => 1, "category" => $category, 'date' => 'DESC']);
        $pagination->setCurrentPage($page);
        $pagination->setLimit(10);

        $allArticles = $this->getDoctrine()->getRepository(Article::class)->findBy(['published' => 1, 'type' => 0], ['date' => 'DESC'], 10, 0);

        return $this->render('Front/category/index.html.twig', [
            'category' => $category,
            'articles' => $pagination,
            'categories' => $categories,
            'allArticles' => $allArticles,
        ]);
    }
}
