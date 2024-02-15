<?php

namespace App\Controller;

use App\Utils\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movie', name: 'app_movie_')]
class MovieController extends AbstractController
{

    #[Route('/favorites', name: 'favorites', methods: ['GET'])]
    public function favorites(): Response
    {
        //todo dynamiser la page favorites
        return $this->render('movie/favorites.html.twig');
    }
    
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        $allMovies = Data::getAllShows();
        return $this->render('movie/list.html.twig', [
            'movieList' => $allMovies
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'], requirements : ['id' => '\d+'])]
    public function show(int $id): Response
    {
        $movie = Data::getOneById($id);

        return $this->render('movie/show.html.twig', [
            'movie' => $movie
        ]);
    }

}
