<?php

namespace App\Controller\Front;

use App\Utils\Data;
use App\Entity\Show;
use App\Repository\ShowRepository;
use App\Repository\GenreRepository;
use App\Repository\CastingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/movie', name: 'app_movie_')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(ShowRepository $showRepository,GenreRepository $genreRepository): Response
    {
        $allMovies = $showRepository->findAll();
        $genres = $genreRepository->findAll();

        // TODO tous les films
        return $this->render('movie/list.html.twig', [
            'showList' => $allMovies,
            'genres'=>$genres
        ]);
    }

    #[Route('/genre/{genre}', name: 'genre', methods: ['GET'])]
    public function listFromGenre(ShowRepository $showRepository,GenreRepository $genreRepository,$genre): Response
    {
        $allMovies = $showRepository->findByGenre($genre);
        $genres = $genreRepository->findAll();
        // dd($allMovies);
        return $this->render('movie/list.html.twig', [
            'showList' => $allMovies,
            'genres'=>$genres

        ]);
    }

    #[Route('/{slug}', name: 'show', methods: ['GET'])]
    public function show(Show $show): Response
    {

        // $movie['id'] = $id;

        // pour trier les castings, on peut le faire
        // - dans twig
        // - dans le controller en PHP
        // - demander à Doctrine de récupérer les castings bien ordonné
        // $castingList = $movie->getCastings()->toArray();

        // $castingList = $castingRepository->findBy(['show' => $movie], ['role' => 'ASC']);
        // dd($castingList);
        // usort($castingList, function ($castingA, $castingB) {
        //     return $castingA->getCreditOrder() <=> $castingB->getCreditOrder();
        // });

        return $this->render('movie/show.html.twig', [
            'show' => $show,
            // 'castingList' => $castingList,
        ]);
    }
}
