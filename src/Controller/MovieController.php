<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movie', name: 'app_movie_')]
class MovieController extends AbstractController
{

    #[Route('/favorites', name: 'favorites', methods: ['GET'])]
    public function favorites(): Response
    {
        return $this->render('movie/favorites.html.twig', [
            'ponjezrfvgnjzer' => 'ONPOZINEF OIJNEFZ',
        ]);
    }
    
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        return $this->render('movie/list.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'], requirements : ['id' => '\d+'])]
    public function show(int $id): Response
    {
        dd($id);
        return $this->render('movie/list.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

}
