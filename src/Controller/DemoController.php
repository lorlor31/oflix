<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use ContainerPub1CDv\getGenreRepositoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/demo/')]
    public function demo(): Response
    {
        $response = new Response();

        $response->setContent('<body><h1>Hello les Jellys</h1></body>');
        // this looks exactly the same
        return $response;
    }

    #[Route('/demo/{id}/{secret}', name: 'app_demo', requirements: ['id' => '\d+'])]
    public function demoParam(int $id, string $secret): Response
    {
        $response = new Response();

        dd($id, $secret);
        $response->setContent('<body><h1>Hello les Jellys</h1></body>');
        // this looks exactly the same
        return $response;
    }

    #[Route('/demo/doctrine')]
    public function doctrine(EntityManagerInterface $entityManager): Response
    {

        $genre = new Genre();
        $genre->setName(uniqid('genre-'));

        // on demande à l'entity manager de prendre en compte cette entité
        $entityManager->persist($genre);


        // on demande à l'entity manager d'exécuter les requêtes
        $entityManager->flush();

        dd($genre);
        return new Response();

    }

    #[Route('/demo/doctrine/read')]
    public function doctrineRead(GenreRepository $genreRepository): Response
    {
        // pour récupérer tous les genres
        $genreList = $genreRepository->findAll();
        // il existe 4 méthodes par défaut : find($id), findAll(), findBy() findOneBy(=)
        dump($genreList);
        dump($genreRepository->findBy(['name' => 'genre-%']));
        dump($genreRepository->find(1));
        dump($genreRepository->find(-1));
        dd($genreRepository->findOneBy(['name' => 'genre-65d344e30c925']));

        // return new Response();


    }
    #[Route('/demo/hello/{name}', methods: ['POST'])]
    public function testPost(string $name): Response
    {
        $response = new Response();

        $response->setContent('<body><h1>Hello ' .  $name . '</h1></body>');
        // this looks exactly the same
        return $response;
    }

    #[Route('/demo/hello/{name}')]
    public function hello(string $name, Request $request): Response
    {
        $session = $request->getSession();
        dump($session);
        $session->set('name', $name);
        dump($session);

        $response = new Response();

        $response->setContent('<body><h1>Hello ' .  $name . '</h1></body>');
        // this looks exactly the same
        return $response;
    }

    #[Route('/demo/session/hello')]
    public function sessionHello(Request $request): Response
    {
        $response = new Response();

        $session = $request->getSession();
        // récupérer le nom qui est dans la session
        // et l'afficher dans le message
        $name = $session->get('name', 'Inconnu des herbes rouges');

        $response->setContent('<body><h1>Hello ' .  $name . '</h1></body>');
        // this looks exactly the same
        return $response;
    }

    

}