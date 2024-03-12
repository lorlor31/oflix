<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;


class GenreController extends AbstractController
{
    #[Route('/api/genres', name: 'app_api_genres_list', methods: ['GET'])]
    public function list(GenreRepository $genreRepository): Response
    {
        return $this->json($genreRepository->findAll(), Response::HTTP_OK, [], [AbstractNormalizer::IGNORED_ATTRIBUTES => ['shows']]);
    }

    #[Route('/api/genres/{id}/shows', name: 'app_api_genres_getShows', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function getShowsByGenre(Genre $genre): Response
    {

        return $this->json($genre, Response::HTTP_OK, [], ["groups" => ["genre", "showLinked"]]);
    }
}
