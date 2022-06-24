<?php

namespace App\Controller;

use App\Form\FullFormType;
use App\Model\FullForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FullFormController extends AbstractController
{
    #[Route('/full-form', name: 'full_form', methods: ['GET', 'POST'])]
    public function fullForm(Request $request): Response
    {
        $fullForm = new FullForm();

        $form = $this->createForm(FullFormType::class, $fullForm);
        $form->handleRequest($request);

        return $this->render('full_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
