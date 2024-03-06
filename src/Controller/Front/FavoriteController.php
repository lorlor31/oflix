<?php

namespace App\Controller\Front;

use App\Entity\Show;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavoriteController extends AbstractController
{
    #[Route('/favorite', name: 'app_favorite_list')]
    public function list(): Response
    {
        $user = $this->getUser();
        /** @var \App\Entity\User $user */
        $showList = $user->getShows();


        return $this->render('favorite/list.html.twig', [
            "showList" => $showList
        ]);
    }

    #[Route('/favorite/add/{id}', name: 'app_favorite_add')]
    public function add(Show $show, EntityManagerInterface $entityManager, Request $request): Response
    {
        // dans le abstract controller on a une méthode toute prête pour récupérer le user courant
        // * pour ceux qui dont vs code ne reconnait pas user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        // on utilise doctrine on lie des objets entre eux, pas besoin de se soucier de clé étrangère de tables pivot ect
        $user->addShow($show);

        $entityManager->flush();

        $this->addFlash("success", "{$show->getTitle()} a bien été ajouté en favoris");

        // récupérer l'url de la page qui a déclenché le add

        $referer = $request->headers->get("referer");
        return $this->redirect($referer);
    }


    #[Route('/favorite/remove/{id}', name: 'app_favorite_remove')]
    public function remove(Show $show, EntityManagerInterface $entityManager, Request $request): Response
    {
        // dans le abstract controller on a une méthode toute prête pour récupérer le user courant
        // * pour ceux qui dont vs code ne reconnait pas user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $show->removeUser($user);

        $entityManager->flush();

        $this->addFlash("warning", "{$show->getTitle()} a bien été supprimé de vos favoris");

        // récupérer l'url de la page qui a déclenché le add

        $referer = $request->headers->get("referer");
        return $this->redirect($referer);
    }

    #[Route('/favorite/empty', name: 'app_favorite_empty')]
    public function empty(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();
        // les shows sont une collection dans user, clear est une méthode de la class collection, elle permet de vider la collection
        /** @var \App\Entity\User $user */
        $user->getShows()->clear();

        // doctrine va regarder l'état de la table maitre
        $entityManager->flush();

        $referer = $request->headers->get("referer");
        return $this->redirect($referer);
    }
}
