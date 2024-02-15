<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{

    #[Route('/favorites', name: 'app_movie_favorites')]
    public function favorites(): Response
    {
        return $this->render('movie/favorites.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }
    
    #[Route('/movie', name: 'app_movie_list')]
    public function list(): Response
    {
        return $this->render('movie/list.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/movie/{id}', name: 'app_movie_show')]
    public function show($id): Response
    {
        dd($id);
        return $this->render('movie/list.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

}
