<?php

namespace App\Controller;

use App\Utils\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function home(): Response
    {
        // récupérer les données
        $allMovies = Data::getAllShows();

        // les fournir à la vue
        return $this->render('main/home.html.twig', [
            'movieList' => $allMovies
        ]);
    }
}