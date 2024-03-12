<?php

namespace App\EventListener;

use App\Entity\Show;
use Symfony\Component\String\Slugger\SluggerInterface;

class ShowListener
{
    public function __construct(private SluggerInterface $slugger)
    {
    }
    public function slugifyTitle(Show $show)
    {
        //  slugifier le titre de show dans slug
        $show->setSlug(strtolower($this->slugger->slug($show->getTitle())));
    }
}
