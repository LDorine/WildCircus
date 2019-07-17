<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Form\BilletType;
use App\Repository\BilletRepository;
use App\Repository\RepresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/billet")
 */
class BilletController extends AbstractController
{
    /**
     * @Route("/", name="billet_index", methods={"GET"})
     * @param BilletRepository $billetRepository
     * @return Response
     */
    public function index(BilletRepository $billetRepository): Response
    {
        return $this->render('billet/index.html.twig', [
            'billets' => $billetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="billet_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $billet = new Billet();
        $ville = $request->query->get('ville');
        $form = $this->createForm(BilletType::class, $billet, ['ville' => $ville]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($billet);
            $entityManager->flush();

            return $this->redirectToRoute('billet_index');
        }

        return $this->render('billet/new.html.twig', [
            'billet' => $billet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="billet_show", methods={"GET"})
     */
    public function show(Billet $billet): Response
    {
        return $this->render('billet/show.html.twig', [
            'billet' => $billet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="billet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Billet $billet): Response
    {
        $form = $this->createForm(BilletType::class, $billet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('billet_index');
        }

        return $this->render('billet/edit.html.twig', [
            'billet' => $billet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="billet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Billet $billet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$billet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($billet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('billet_index');
    }
}
