<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RepresentationController extends AbstractController
{
    /**
     * @Route("/representation", name="representation")
     */
    public function index()
    {
        return $this->render('representation/index.html.twig');
    }
}
