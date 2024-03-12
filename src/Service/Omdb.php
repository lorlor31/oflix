<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Omdb
{
    //  constante avec l'url de l'api
    const URL = "http://www.omdbapi.com/";

    public function __construct(
        // tout ceci sera instancié via le conteneur de service
        private HttpClientInterface $client,
        private string $apiKey
    ) {
        // dd ici si vous voulez tester votre apiKey
    }

    public function fetch(string $title)
    {
        $response = $this->client->request(
            // la method HTTP
            'GET',
            // L'url
            self::URL,
            // Les options
            [
                // pour ajouter des query params à la requeste ex www.api.com?apiKey=...
                "query" => [
                    "apiKey" => $this->apiKey,
                    "t" => $title
                ]
            ]
        );
        $content = $response->toArray();

        return $content;
    }

    public function fetchPoster(string $title): ?string
    {
        $show = $this->fetch($title);

        if (!array_key_exists("Poster", $show)) {
            return null;
        }

        return $show["Poster"];
    }
}
