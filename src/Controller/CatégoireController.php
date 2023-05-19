<?php

namespace App\Controller;

use App\Entity\Catégoire;
use App\Form\CatégoireType;
use App\Repository\CatégoireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cat/goire')]
class CatégoireController extends AbstractController
{
    #[Route('/', name: 'app_cat_goire_index', methods: ['GET'])]
    public function index(CatégoireRepository $catégoireRepository): Response
    {
        return $this->render('catégoire/index.html.twig', [
            'cat_goires' => $catégoireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cat_goire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CatégoireRepository $catégoireRepository): Response
    {
        $catégoire = new Catégoire();
        $form = $this->createForm(CatégoireType::class, $catégoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catégoireRepository->save($catégoire, true);

            return $this->redirectToRoute('app_cat_goire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('catégoire/new.html.twig', [
            'cat_goire' => $catégoire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cat_goire_show', methods: ['GET'])]
    public function show(Catégoire $catégoire): Response
    {
        return $this->render('catégoire/show.html.twig', [
            'cat_goire' => $catégoire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cat_goire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Catégoire $catégoire, CatégoireRepository $catégoireRepository): Response
    {
        $form = $this->createForm(CatégoireType::class, $catégoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catégoireRepository->save($catégoire, true);

            return $this->redirectToRoute('app_cat_goire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('catégoire/edit.html.twig', [
            'cat_goire' => $catégoire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cat_goire_delete', methods: ['POST'])]
    public function delete(Request $request, Catégoire $catégoire, CatégoireRepository $catégoireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catégoire->getId(), $request->request->get('_token'))) {
            $catégoireRepository->remove($catégoire, true);
        }

        return $this->redirectToRoute('app_cat_goire_index', [], Response::HTTP_SEE_OTHER);
    }
}
