<?php

namespace App\Controller\Back;

use App\Entity\Stadium;
use App\Form\StadiumType;
use App\Repository\StadiumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stadium")
 */
class StadiumController extends AbstractController
{
    /**
     * @Route("/", name="stadium_index", methods="GET")
     */
    public function index(StadiumRepository $stadiumRepository): Response
    {
        return $this->render('back/stadium/index.html.twig', ['stadia' => $stadiumRepository->findAll()]);
    }

    /**
     * @Route("/new", name="stadium_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $stadium = new Stadium();
        $form = $this->createForm(StadiumType::class, $stadium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stadium);
            $em->flush();

            return $this->redirectToRoute('stadium_index');
        }

        return $this->render('back/stadium/new.html.twig', [
            'stadium' => $stadium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stadium_show", methods="GET")
     */
    public function show(Stadium $stadium): Response
    {
        return $this->render('back/stadium/show.html.twig', ['stadium' => $stadium]);
    }

    /**
     * @Route("/{id}/edit", name="stadium_edit", methods="GET|POST")
     */
    public function edit(Request $request, Stadium $stadium): Response
    {
        $form = $this->createForm(StadiumType::class, $stadium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stadium_index', ['id' => $stadium->getId()]);
        }

        return $this->render('back/stadium/edit.html.twig', [
            'stadium' => $stadium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stadium_delete", methods="DELETE")
     */
    public function delete(Request $request, Stadium $stadium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stadium->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stadium);
            $em->flush();
        }

        return $this->redirectToRoute('stadium_index');
    }
}
