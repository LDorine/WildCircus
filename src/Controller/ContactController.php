<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request, \Swift_Mailer $mailer) : Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $mail = $form->getData()->getMail();

            $message = (new \Swift_Mailer('Le WildCircus à bien reçu ton message.'))
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($mail)
                ->setBody(
                    $this->renderView(
                    'contact/mail.html.twig',
                    ['people' => $form->getData()]
                ),
                    'text/html'
                );

            $mailer->send($message);

            return $this->redirectToRoute('home_index');
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }
}
