<?php

namespace App\Controller\Front;

use App\Entity\Show;
use App\Repository\CastingRepository;
use App\Repository\ShowRepository;
use App\Utils\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movie', name: 'app_movie_')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(ShowRepository $showRepository): Response
    {
        $allMovies = $showRepository->findAll();

        // TODO tous les films
        return $this->render('movie/list.html.twig', [
            'showList' => $allMovies
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
