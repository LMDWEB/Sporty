<?php

namespace App\Controller\Back;

use App\Entity\Channel;
use App\Form\ChannelType;
use App\Repository\ChannelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/channel")
 */
class ChannelController extends AbstractController
{
    /**
     * @Route("/", name="channel_index", methods="GET")
     */
    public function index(ChannelRepository $channelRepository): Response
    {
        return $this->render('Back/channel/index.html.twig', ['channels' => $channelRepository->findAll()]);
    }

    /**
     * @Route("/new", name="channel_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $channel = new Channel();
        $form = $this->createForm(ChannelType::class, $channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($channel);
            $em->flush();

            $this->addFlash('success' , 'La chaine a bien été ajouté !');

            return $this->redirectToRoute('channel_index');
        }

        return $this->render('Back/channel/new.html.twig', [
            'channel' => $channel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="channel_show", methods="GET")
     */
    public function show(Channel $channel): Response
    {
        return $this->render('Back/channel/show.html.twig', ['channel' => $channel]);
    }

    /**
     * @Route("/{id}/edit", name="channel_edit", methods="GET|POST")
     */
    public function edit(Request $request, Channel $channel): Response
    {
        $form = $this->createForm(ChannelType::class, $channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success' , 'La chaine a bien été mise à jour !');

            return $this->redirectToRoute('channel_index', ['id' => $channel->getId()]);
        }

        return $this->render('Back/channel/edit.html.twig', [
            'channel' => $channel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="channel_delete", methods="DELETE")
     */
    public function delete(Request $request, Channel $channel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$channel->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($channel);
            $em->flush();

            $this->addFlash('success' , 'La chaine a bien été supprimé !');
        }

        return $this->redirectToRoute('channel_index');
    }
}
