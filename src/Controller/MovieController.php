<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movies', name: 'app_movies')]
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route('/movie/{id<\d+>?1}', name: 'app_movie')]
    public function details(MovieRepository $movieRepository, int $id): Response
    {
        $movie = $movieRepository->find($id);
        return $this->render('movie/detail.html.twig', [
            'movie' => $movie
        ]);
    }
}
