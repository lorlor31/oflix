<?php

namespace App\Tests\Integration\Service;

use App\Service\Omdb;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OmdbTest extends KernelTestCase
{
    private const TEST_CASES = [

        "Dune",
        "Room",
        "V for Vendetta",
        "La la land",
    ];

    public function testFetch(): void
    {

        // on lance symfony 
        $kernel = self::bootKernel();
        // on récupère le conteneur de service
        $container = static::getContainer();
        // une fois que j'ai accès au conteneur
        $omdb = $container->get(Omdb::class);

        foreach (self::TEST_CASES as $title) {
            //  fetcher et tester
            $show = $omdb->fetch($title);

            // est ce que je recois un tableau
            $this->assertIsArray($show);
            // est ce que je recois un tableau avec un index titre
            $this->assertArrayHasKey("Title", $show);
            // est ce que le titre recu est le même que le titre donné
            $this->assertEqualsIgnoringCase($title, $show["Title"]);
        }


        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
