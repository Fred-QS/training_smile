<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Provider\MovieProvider;

#[AsCommand(
    name: 'movie:search',
    description: 'Search movie by imdbID or Title',
)]
class SearchMovieCommand extends Command
{
    public function __construct(private MovieProvider $movieProvider, string $name = 'movie:search')
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Title or imdbID')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Film title')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        $data = null;

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            $data = $input->getOption('option1');
        }

        while ($data === null) {
            $data = $io->ask('Choose a film title or imdbID');
        }

        $movie = $this->movieProvider->getMovieByTitle($data);
        if ($movie === null) {
            $movie = $this->movieProvider->getMovieByImdbId($data);
        }

        $io->writeln('ID: ' . $movie->getId());
        $io->writeln('ImdbID: ' . $movie->getImdbId());
        $io->writeln('Title: ' . $movie->getTitle());
        $io->writeln('Released: ' . date_format($movie->getReleasedAt(), "d/m/Y"));

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
