<?php

namespace App\Controller;

use App\Entity\Programme;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeController extends AbstractController
{
    /**
     * @Route("/programme", name="programme")
     */
    public function index()
    {
        return $this->render('programme/index.html.twig');
    }
}
