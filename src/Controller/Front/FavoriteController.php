<?php

namespace App\Controller\Front;

use App\Entity\Show;
use App\Service\Favorite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavoriteController extends AbstractController
{
    public function __construct(private Favorite $favorite)
    {
    }
    #[Route('/favorite', name: 'app_favorite_list')]
    public function list(): Response
    {
        return $this->render('favorite/list.html.twig', [
            "showList" => $this->favorite->getAll()
        ]);
    }

    #[Route('/favorite/add/{id}', name: 'app_favorite_add')]
    public function add(Request $request, Show $show): Response
    {
        $this->favorite->add($show);

        // récupérer l'url de la page qui a déclenché le add
        $referer = $request->headers->get("referer");
        return $this->redirect($referer);
    }


    #[Route('/favorite/remove/{id}', name: 'app_favorite_remove')]
    public function remove(Show $show, Request $request): Response
    {


        $this->favorite->remove($show);
        // récupérer l'url de la page qui a déclenché le add

        $referer = $request->headers->get("referer");
        return $this->redirect($referer);
    }

    #[Route('/favorite/empty', name: 'app_favorite_empty')]
    public function empty(Request $request): Response
    {


        $this->favorite->empty();

        $referer = $request->headers->get("referer");
        return $this->redirect($referer);
    }
}
