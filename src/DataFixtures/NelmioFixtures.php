<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Nelmio\Alice\Loader\NativeLoader;

class NelmioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // on demande au composant de créer les objets
        $loader = new NativeLoader();
        $entityList = $loader->loadFile(__DIR__.'/fixtures.yaml');

        foreach($entityList as $currentEntity)
        {
            $manager->persist($currentEntity);
        }

        $manager->flush();
    }
}
