<?php

namespace App\Controller\Back;

use App\Entity\Article;
use App\Entity\Thread;
use App\Form\ThreadType;
use App\Repository\ThreadRepository;
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
     * @Route("/", name="thread_index", methods="GET")
     */
    public function index(ThreadRepository $threadRepository): Response
    {
        return $this->render('Back/thread/index.html.twig', ['threads' => $threadRepository->findAll()]);
    }

    /**
     * @Route("/new", name="thread_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $thread = new Thread();
        $form = $this->createForm(ThreadType::class, $thread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($thread);
            $em->flush();

            return $this->redirectToRoute('thread_index');
        }

        return $this->render('Back/thread/new.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="thread_show", methods="GET")
     */
    public function show(Thread $thread): Response
    {
        $articles = $thread->getArticles();

        return $this->render('Back/thread/show.html.twig', [
            'thread' => $thread,
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/{id}/edit", name="thread_edit", methods="GET|POST")
     */
    public function edit(Request $request, Thread $thread): Response
    {
        $form = $this->createForm(ThreadType::class, $thread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('thread_index', ['id' => $thread->getId()]);
        }

        return $this->render('Back/thread/edit.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="thread_delete", methods="DELETE")
     */
    public function delete(Request $request, Thread $thread): Response
    {
        if ($this->isCsrfTokenValid('delete'.$thread->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($thread);
            $em->flush();
        }

        return $this->redirectToRoute('thread_index');
    }
}
