<?php

namespace App\Tests\Unit\Service;

use App\Service\Omdb;
use PHPUnit\Framework\TestCase;

class OmdbTest extends TestCase
{
    public function testFetchPoster(): void
    {

        //* avec createMock on est obligé de redéfinir TOUTES les fonctions et leur résultats attendu sur l'objet mocké
        // $omdbMock =  $this->createMock(Omdb::class);

        //* crée une copie simulé de omdb
        $omdbMock = $this->getMockBuilder(Omdb::class)
            // ignore le constructeur 
            ->disableOriginalConstructor()
            // préciser que je vais simuler l'action de fetch
            ->onlyMethods(["fetch"])
            // crée l'objet pour le stocker dans la variable
            ->getMock();
        //* Simulé le comportement attendu de fetch
        $omdbMock
            ->method("fetch")
            ->with("borat")
            ->willReturn(["Title" => "Borat", "Poster" => "https://m.media-amazon.com/images/M/MV5BMTk0MTQ3NDQ4Ml5BMl5BanBnXkFtZTcwOTQ3OTQzMw@@._V1_SX300.jpg"]);

        // je vais chercher le poster 
        $poster = $omdbMock->fetchPoster("borat");

        // je vérifie que le poster que je recois est bien le poster attendu
        $this->assertEquals("https://m.media-amazon.com/images/M/MV5BMTk0MTQ3NDQ4Ml5BMl5BanBnXkFtZTcwOTQ3OTQzMw@@._V1_SX300.jpg", $poster);
    }
}
