<?php

namespace App\Controller\Back;

use App\Entity\Configuration;
use App\Form\ConfigurationType;
use App\Repository\ConfigurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/configuration")
 */
class ConfigurationController extends AbstractController
{
    /**
     * @Route("/", name="configuration_index", methods="GET")
     */
    public function index(ConfigurationRepository $configurationRepository): Response
    {
        return $this->render('Back/configuration/index.html.twig', ['configurations' => $configurationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="configuration_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $configuration = new Configuration();
        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($configuration);
            $em->flush();

            return $this->redirectToRoute('configuration_index');
        }

        return $this->render('Back/configuration/new.html.twig', [
            'configuration' => $configuration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="configuration_show", methods="GET")
     */
    public function show(Configuration $configuration): Response
    {
        return $this->render('Back/configuration/show.html.twig', ['configuration' => $configuration]);
    }

    /**
     * @Route("/{id}/edit", name="configuration_edit", methods="GET|POST")
     */
    public function edit(Request $request, Configuration $configuration): Response
    {
        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('configuration_index', ['id' => $configuration->getId()]);
        }

        return $this->render('Back/configuration/edit.html.twig', [
            'configuration' => $configuration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="configuration_delete", methods="DELETE")
     */
    public function delete(Request $request, Configuration $configuration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configuration->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($configuration);
            $em->flush();
        }

        return $this->redirectToRoute('configuration_index');
    }
}
