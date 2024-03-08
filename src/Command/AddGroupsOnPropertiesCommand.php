<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'app:add-groups-on-properties',
    description: 'Add a short description for your command',
)]
class AddGroupsOnPropertiesCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->setDescription('Ajoute des annotations aux entités.')
        ->setHelp('Cette commande ajoute des annotations aux entités.')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // using of Finder component to find all files in src/Entity
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../../src/Entity')->name('*.php');



        foreach ($finder as $file) {
            $filePath = $file->getRealPath();
            $content = file_get_contents($filePath);
            
            // put className in a variable
            preg_match('/class\s+(\w+)\s+/', $content, $matches);
            // $className captured
            $className = strtolower($matches[1]);
             // if groups with $classNameLinked already in the file => skip 
             if (strpos($content, "#[Groups(['{$className}Linked'])]") !== false) {
                $io->warning("Annotations déjà présentes dans {$file->getFilename()}");
                continue;
            }
            // looking for all columns
            $content = preg_replace_callback(
                '/(#\[ORM\\\Column.*\n)/',
                function ($matches) use ($className) {
                    return $matches[0]."\t#[Groups(['{$className}Linked'])]\n";
                },
                $content
            );
            
            // I write the new content in the file
            file_put_contents($filePath, $content);
            $output->writeln("Annotations ajoutées à {$file->getFilename()}");

        }
         $io->success('Annotations ajoutées à toutes les entités.');

        return Command::SUCCESS;
    }
}
