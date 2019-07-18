<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Form\BilletType;
use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class BilletController extends AbstractController
{
    /**
     * @Route("/billet/new", name="billet_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('representation');
        }

        return $this->render('billet/new.html.twig', [
            'billet' => $billet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/billet/{id}", name="billet_show", methods={"GET"})
     */
    public function show(Billet $billet): Response
    {
        return $this->render('billet/show.html.twig', [
            'billet' => $billet,
        ]);
    }

    /**
     * @Route("/billet/{id}/edit", name="billet_edit", methods={"GET","POST"})
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
     * @Route("/price", name="price")
     */
    public function price(PlaceRepository $pr) {
        $price = $pr->findAll();

        $encoders = [new XmlEncoder(), new JsonEncode()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($price, 'json');
        $json = new JsonResponse($jsonContent, 200, []);
        return $json;
    }
}
