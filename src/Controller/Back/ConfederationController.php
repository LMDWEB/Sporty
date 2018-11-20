<?php

namespace App\Controller\Back;

use App\Entity\Confederation;
use App\Form\ConfederationType;
use App\Repository\ConfederationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/confederation")
 */
class ConfederationController extends AbstractController
{
    /**
     * @Route("/", name="confederation_index", methods="GET")
     */
    public function index(ConfederationRepository $confederationRepository): Response
    {
        return $this->render('back/confederation/index.html.twig', ['confederations' => $confederationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="confederation_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $confederation = new Confederation();
        $form = $this->createForm(ConfederationType::class, $confederation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($confederation);
            $em->flush();

            return $this->redirectToRoute('confederation_index');
        }

        return $this->render('back/confederation/new.html.twig', [
            'confederation' => $confederation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="confederation_show", methods="GET")
     */
    public function show(Confederation $confederation): Response
    {
        return $this->render('back/confederation/show.html.twig', ['confederation' => $confederation]);
    }

    /**
     * @Route("/{id}/edit", name="confederation_edit", methods="GET|POST")
     */
    public function edit(Request $request, Confederation $confederation): Response
    {
        $form = $this->createForm(ConfederationType::class, $confederation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('confederation_index', ['id' => $confederation->getId()]);
        }

        return $this->render('back/confederation/edit.html.twig', [
            'confederation' => $confederation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="confederation_delete", methods="DELETE")
     */
    public function delete(Request $request, Confederation $confederation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$confederation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($confederation);
            $em->flush();
        }

        return $this->redirectToRoute('confederation_index');
    }
}
