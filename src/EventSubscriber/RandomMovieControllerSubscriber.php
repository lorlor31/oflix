<?php

namespace App\EventSubscriber;

use App\Repository\ShowRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class RandomMovieControllerSubscriber implements EventSubscriberInterface
{
    public function __construct(private ShowRepository $showRepository, private Environment $twig)
    {
    }
    public function onKernelController(ControllerEvent $event): void
    {
        $show = $this->showRepository->findOneRandom();
        $this->twig->addGlobal("randomShow", $show);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
