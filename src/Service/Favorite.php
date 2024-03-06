<?php

namespace App\Service;

use App\Entity\Show;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Favorite
{
    // une propriété pour éviter de récupérer le user dans chaque méthode
    private User $user;

    public function __construct(private Security $security, private EntityManagerInterface $entityManager, private RequestStack $requestStack)
    {
        $this->user = $this->security->getUser();
        // Accessing the session in the constructor is *NOT* recommended, since
        // it might not be accessible yet or lead to unwanted side-effects
        // $this->session = $requestStack->getSession();
        https: //symfony.com/doc/current/session.html#session-intro
        // c'est pourquoi je ne fais pas ça ici : 
        //// $this->flashBag = $requestStack->getSession()->getFlashBag();
    }

    public function getAll()
    {
        return $this->user->getShows();
    }
    public function add(Show $show)
    {

        // on utilise doctrine on lie des objets entre eux, pas besoin de se soucier de clé étrangère de tables pivot ect
        $this->user->addShow($show);
        $this->entityManager->flush();

        /**
         * @var Session
         */
        $session = $this->requestStack->getSession();
        $flashBag = $session->getFlashBag();
        $flashBag->add("success", "{$show->getTitle()} a bien été ajouté en favoris");
    }

    public function remove(Show $show)
    {

        $show->removeUser($this->user);

        $this->entityManager->flush();

        /**
         * @var Session
         */
        $session = $this->requestStack->getSession();
        $flashBag = $session->getFlashBag();
        $flashBag->add("warning", "{$show->getTitle()} a bien été supprimé de vos favoris");
    }

    public function empty()
    {
        $this->user->getShows()->clear();
        // doctrine va regarder l'état de la table maitre
        $this->entityManager->flush();
    }
}
