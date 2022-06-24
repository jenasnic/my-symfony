<?php

namespace App\Controller\Back;

use App\Entity\MyModel;
use App\Form\MyModelType;
use App\Repository\MyModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/my-model')]
class MyModelController extends AbstractController
{
    #[Route('/', name: 'back_my_model_index', methods: ['GET'])]
    public function index(MyModelRepository $myModelRepository): Response
    {
        return $this->render('back/my_model/index.html.twig', [
            'my_models' => $myModelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'back_my_model_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MyModelRepository $myModelRepository): Response
    {
        $myModel = new MyModel();
        $form = $this->createForm(MyModelType::class, $myModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $myModelRepository->add($myModel, true);

            return $this->redirectToRoute('back_my_model_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/my_model/new.html.twig', [
            'my_model' => $myModel,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'back_my_model_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MyModel $myModel, MyModelRepository $myModelRepository): Response
    {
        $form = $this->createForm(MyModelType::class, $myModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $myModelRepository->add($myModel, true);

            return $this->redirectToRoute('back_my_model_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/my_model/edit.html.twig', [
            'my_model' => $myModel,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'back_my_model_delete', methods: ['POST'])]
    public function delete(Request $request, MyModel $myModel, MyModelRepository $myModelRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myModel->getId(), $request->request->get('_token'))) {
            $myModelRepository->remove($myModel, true);
        }

        return $this->redirectToRoute('back_my_model_index', [], Response::HTTP_SEE_OTHER);
    }
}
