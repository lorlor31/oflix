<?php

namespace App\Controller\Api;

use App\Entity\Casting;
use App\Entity\Person;
use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ShowController extends AbstractController
{
    #[Route('/api/shows', name: 'app_api_show_list')]
    public function list(ShowRepository $showRepository): JsonResponse
    {
        //  appeler les films en bdd
        return $this->json($showRepository->findAll(), Response::HTTP_OK, [], [
            "groups" => ["show", "castingLinked", "reviewLinked", "userLinked", "seasonLinked", "genreLinked"]
        ]);
    }
}
