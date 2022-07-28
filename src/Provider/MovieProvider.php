<?php

namespace App\Provider;

use App\Consumer\OMDbApiConsumer;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Transformer\OmdbMovieTransformer;

class MovieProvider
{
    public function __construct(
        private MovieRepository $movieRepository,
        private OMDbApiConsumer $consumer,
        private OmdbMovieTransformer $transformer
    ) {}

    public function getMovieByTitle(string $title)
    {
        $movie = $this->movieRepository->findByLowerTitle($title) ??
            $this->transformer->transform(
                $this->consumer->consume(OMDbApiConsumer::MODE_TITLE, $title)
            );

        if ($movie && !$movie->getId()) {
            $this->movieRepository->add($movie, true);
        }

        return $movie;
    }

    public function getMovieByImdbId(string $code)
    {
        $movie = $this->movieRepository->findByImdbId($code) ??
            $this->transformer->transform(
                $this->consumer->consume(OMDbApiConsumer::MODE_ID, $code)
            );

        if ($movie && !$movie->getId()) {
            $this->movieRepository->add($movie, true);
        }

        return $movie;
    }
}

