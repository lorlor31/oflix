<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController
{
    #[Route('/demo/')]
    public function demo(): Response
    {
        $response = new Response();

        $response->setContent('<h1>Hello les Jellys</h1>');
        // this looks exactly the same
        return $response;
    }
}