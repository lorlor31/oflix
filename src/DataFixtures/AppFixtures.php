<?php

namespace App\DataFixtures;

use App\Entity\Season;
use App\Entity\Show;
use App\Repository\GenreRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    private $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }
  
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $faker->seed(1234);
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\TvShow($faker));

        $genreList = $this->genreRepository->findAll();

        $nbMovies = 100;
        for ($currentMovieNumber = 0; $currentMovieNumber < $nbMovies; $currentMovieNumber++)
        {
            // créer une liste de show
            $show = new Show();
    
            $show->setDuration($faker->numberBetween(90,240));
            $show->setSummary($faker->paragraph());
            $show->setSynopsis($faker->overview());
            $show->setRating($faker->randomFloat(1,0,5));
            $show->setCountry($faker->country());


            $nbGenre = $faker->numberBetween(1, 4);
            for ($i = 0; $i < $nbGenre; $i++)
            {
                $show->addGenre($faker->randomElement($genreList));
            }

            $showTitle = '';
            if ($faker->numberBetween(1, 3) > 1)
            {
                $showTitle = $faker->movie();
                $show->setType('Film');
            }
            else 
            {

                $showTitle = $faker->tvShow();
                $show->setType('Série');
                // créer une liste de saisons
                    // associe la saison à un show
                $seasonCount = $faker->tvShowTotalSeasons(1, 5);
    
                for($currentSeasonNumber = 1; $currentSeasonNumber <= $seasonCount; $currentSeasonNumber++)
                {
                    $season = new Season();
                    $season->setNumber($currentSeasonNumber);
                    $season->setEpisodeCount($faker->tvShowTotalEpisodes(2,9));
                    // ici on fait la jointure entre le show créé et la saison
                    $season->setShow($show);
    
                    // on informe l'entité manager qu'il y a une nouvelle entité à insérer en BDD
                    $manager->persist($season);
                }
            }
            $show->setTitle($showTitle);
            // on a besoin du titre du film / série
            $show->setPoster($faker->imageUrl(203, 300, $showTitle));
            
            // on informe l'entité manager qu'il y a une nouvelle entité à insérer en BDD
            $manager->persist($show);

        }

        // on demande d'exécuter les requetes
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GenreFixtures::class,
        ];
    }
    private function getCountryList()
    {
        return [
            'France',
            'Etats Unis',
            'Allemagne',
            'Angleterre',
            'Mali',
            'Irlande',
            'Inde',
            'Empire Romain',
        ];
    }

    private function getRandomCountry()
    {
        $countryList = $this->getCountryList();
        shuffle($countryList);
        return $countryList[0];
    }
}