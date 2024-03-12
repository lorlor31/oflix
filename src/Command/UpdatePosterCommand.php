<?php

namespace App\Command;

use App\Entity\Show;
use App\Service\MailerService;
use App\Service\Omdb;
use Doctrine\DBAL\Schema\MySQLSchemaManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// en attribut le name permet de lancer la commande
// la description de la décrire dans bin/console list
#[AsCommand(
    name: 'app:update-poster',
    description: 'Update all poster of shows with omdbApi',
)]
class UpdatePosterCommand extends Command
{
    public function __construct(private Omdb $omdb, private EntityManagerInterface $entityManager, private MailerService $mailer)
    {
        // permet d'appeller le constructeur parent car il est OBLIGATOIRE pour faire fonctionner une commande
        parent::__construct();
    }


    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        // input correspond aux entrée utilisateur
        // output correspond aux infos qu'on affichera à l'utilisateur
        $io = new SymfonyStyle($input, $output);

        $io->title("Les films commencent à être scannés");
        //  changer les images des films
        //  1 - chercher tous les films
        $shows = $this->entityManager->getRepository(Show::class)->findAll();
        //  2 - boucler sur les films

        // nombre pour sauvegarder les films sans poster dans l'api
        $fail = 0;
        $success = 0;
        foreach ($io->progressIterate($shows) as $show) {
            //  3 - fetchPoster
            $poster = $this->omdb->fetchPoster($show->getTitle());

            //  3.5 - vérifier qu'on a bien récupérer un poster
            if ($poster !== "N/A" && $poster !== null) {
                //  4 - mettre à jour le poster du film
                $show->setPoster($poster);
                $success++;
            } else {
                $fail++;
            }
        }
        //  5 - flush
        $this->entityManager->flush();
        //  BONUS - stylisier la commande
        $io->note("Nombre de film sans poster dans l'api $fail");
        $io->success("Les images ont finis de se mettre à jour");
        //  BONUS BONUS - Avoir un mail compte-rendu
        $this->mailer->send("Actualisation des images", "email/update_images.html.twig", [
            "fail" => $fail,
            "success" => $success
        ]);

        return Command::SUCCESS;
    }
}
