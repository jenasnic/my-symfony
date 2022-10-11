<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{
    public function __construct(
    ) {
    }

    /**
     * @Route(path="/", name="home")
     */
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }
}
