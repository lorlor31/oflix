<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DemoController
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

        $session->set('name', $name);
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