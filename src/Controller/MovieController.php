<?php

namespace App\Controller;

use App\Utils\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movie', name: 'app_movie_')]
class MovieController extends AbstractController
{

    #[Route('/favorites', name: 'favorites', methods: ['GET'])]
    public function favorites(Request $req): Response
    {
        // récupérer les données 
        // ici les films dans la session
        $session = $req->getSession();
        $favoriteMovies = $session->get('favorite_movies', []);

        //todo dynamiser la page favorites
        return $this->render('movie/favorites.html.twig', [
            'movieList' => $favoriteMovies
        ]);
    }
    
    #[Route('/favorites/{id<\d+>}', name: 'favorites_add', methods: ['GET'])]
    public function favoritesAdd(int $id, Request $request): Response
    {
        // récupérer l'id de l'url done !
        // récupérer le movie qui correspond à l'id
        $movie = Data::getOneById($id);

        // todo vérifier que movie n'est pas un tableau vide
        // todo si c'est le cas que faire ? 

        // ajouter le movie dans la session
        $session = $request->getSession();
        // récupérer les éventuels movies en sessions dans une variable $moviesInSession
        $moviesInSession = $session->get('favorite_movies', []);

        // ajouter le movie actuel dans le tableau $moviesInSession
        $moviesInSession[$id] = $movie;

        // réécrire le tableau dans la session ( à la meme clef )
        $session->set('favorite_movies', $moviesInSession); 

        $this->addFlash('success', 'Le film ' . $movie['title'] . ' a été ajouté avec succès');

        // rediriger l'utilisateur sur la page /favorites
        return $this->redirectToRoute('app_movie_favorites');

    }
    
    #[Route('/favorites/remove/{id<\d+>}', name: 'favorites_remove', methods: ['GET'])]
    public function favoritesRemove(int $id, Request $request): Response
    {


        $session = $request->getSession();
        // récupérer les éventuels movies en sessions dans une variable $moviesInSession
        $moviesInSession = $session->get('favorite_movies', []);

        // supprimer le film du tableau des favoris
        unset($moviesInSession[$id]);
        // todo afficher le nom du film dans le message flash
        $this->addFlash('success', 'Le film a été supprimé de vos favoris');

        // réécrire le tableau dans la session ( à la meme clef )
        $session->set('favorite_movies', $moviesInSession); 


        // rediriger l'utilisateur sur la page /favorites
        return $this->redirectToRoute('app_movie_favorites');

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
        $movie['id'] = $id;

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
            'movie_id' => $id,
        ]);
    }

    // todo ajouter une page pour vider la liste des favoris
}
