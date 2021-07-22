<?php

namespace App\Controller;

use App\Entity\SearchGlobal;
use App\Form\SearchGlobalType;
use App\Service\GlobalSearchProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request, GlobalSearchProvider $searchProvider): Response
    {
        $search = new SearchGlobal();
        $form = $this->createForm(SearchGlobalType::class, $search);
        $form->handleRequest($request);
        $result = null;
        $type = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $searchProvider->createSearch($search);
            $result = $search->getResult();
            $type = $search->getType();
        }
        return $this->render('home/search.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
            'type' => $type
    ]);
    }
}
