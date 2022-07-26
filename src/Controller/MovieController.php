<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{

    private array $movies = ['Les minions', 'Mer des monstres', 'Transformers', 'Start Wars IV'];

    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'movies' => $this->movies,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route('/movie/{name}', name: 'app_movie')]
    public function show(string $name): Response
    {
        $details = [
            'title' => urldecode($name),
            'releasedAt' => new \DateTimeImmutable('2022-01-22'),
            'genres' => [
                'SF',
                'Drama',
                'Family'
            ]
        ];
        return $this->render('movie/detail.html.twig', [
            'details' => $details
        ]);
    }
}
