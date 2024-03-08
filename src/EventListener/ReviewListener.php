<?php

namespace App\EventListener;

use App\Entity\Review;
use App\Repository\ReviewRepository;

class ReviewListener
{
    public function __construct(private ReviewRepository $reviewRepository)
    {
    }
    public function updateMovieRating(Review $review)
    {
        // je récupère le film
        $show = $review->getMovie();

        // j'initialise une variable pour additionner les notes
        $allNotes = 0;
        // je récupère les reviews et je boucle dessus
        foreach ($show->getReviews() as $review) {
            // j'additionne toutes les notes
            $allNotes += $review->getRating();
        }
        // formule de calcul de moyenne
        $rating = $allNotes / count($show->getReviews());
        // on balance le tout dans le film
        // round = arondir, 1 = un chiffre après la virgule
        $show->setRating(round($rating, 1));
    }

    // ! probleme de flush pour movie à méditer ...
    // public function updateMovieRatingV2(Review $review)
    // {
    //     $movie = $review->getMovie();
    //     $rating = $this->reviewRepository->findAverageRating($movie->getId());
    //     dd($rating);
    //     $movie->setRating(round($rating[1], 1));
    // }
}
