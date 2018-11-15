<?php

namespace App\Controller\Back;

use App\Entity\Partnership;
use App\Form\PartnershipType;
use App\Repository\PartnershipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/partnership")
 */
class PartnershipController extends AbstractController
{
    /**
     * @Route("/", name="partnership_index", methods="GET")
     */
    public function index(PartnershipRepository $partnershipRepository): Response
    {
        return $this->render('Back/partnership/index.html.twig', ['partnerships' => $partnershipRepository->findAll()]);
    }

    /**
     * @Route("/new", name="partnership_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $partnership = new Partnership();
        $form = $this->createForm(PartnershipType::class, $partnership);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partnership);
            $em->flush();

            return $this->redirectToRoute('partnership_index');
        }

        return $this->render('Back/partnership/new.html.twig', [
            'partnership' => $partnership,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partnership_show", methods="GET")
     */
    public function show(Partnership $partnership): Response
    {
        return $this->render('Back/partnership/show.html.twig', ['partnership' => $partnership]);
    }

    /**
     * @Route("/{id}/edit", name="partnership_edit", methods="GET|POST")
     */
    public function edit(Request $request, Partnership $partnership): Response
    {
        $form = $this->createForm(PartnershipType::class, $partnership);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partnership_index', ['id' => $partnership->getId()]);
        }

        return $this->render('Back/partnership/edit.html.twig', [
            'partnership' => $partnership,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partnership_delete", methods="DELETE")
     */
    public function delete(Request $request, Partnership $partnership): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partnership->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partnership);
            $em->flush();
        }

        return $this->redirectToRoute('partnership_index');
    }
}
