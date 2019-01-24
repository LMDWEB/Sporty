<?php

namespace App\Controller\Back;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods="GET")
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('Back/event/index.html.twig', ['events' => $eventRepository->findAll()]);
    }

    /**
     * @Route("/new", name="event_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $this->addFlash('success' , 'L\'evenement a bien été ajouté !');

            return $this->redirectToRoute('event_index');
        }

        return $this->render('Back/event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods="GET")
     */
    public function show(Event $event): Response
    {
        return $this->render('Back/event/show.html.twig', ['event' => $event]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods="GET|POST")
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success' , 'L\'evenement a bien été mise à jour !');

            return $this->redirectToRoute('event_index', ['id' => $event->getId()]);
        }

        return $this->render('Back/event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods="DELETE")
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();

            $this->addFlash('success' , 'L\'evenement a bien été supprimé !');
        }

        return $this->redirectToRoute('event_index');
    }

    public function list(){

        $matchday = array();

        for ($i = 1; $i < 50; $i++) {
            if ($i != 1) {
                $matchday[$i] = $i . "ème journée";
            } else {
                $matchday[$i] = $i . "ère journée";
            }
        }

        array_push(
            $matchday,
            "64ème de finale",
            "32ème de finale",
            "16ème de finale",
            "8ème de finale",
            "Quart de finale",
            "Demi finale",
            "Petite finale",
            "Finale"
        );

        return $matchday;
    }
}
