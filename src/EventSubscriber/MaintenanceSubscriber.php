<?php

namespace App\EventSubscriber;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    public function __construct(private ParameterBagInterface $params)
    {
    }
    public function onKernelResponse(ResponseEvent $event): void
    {
        // je récupere les params du container
        if (!empty($this->params->get("app.maintenance"))) {
            $message = $this->params->get("app.maintenance");
        } else {
            // early return qui vient couper la fonction pour éviter qu'elle s'execute en entier
            return;
        }
        // je récupère la réponse
        $response = $event->getResponse();
        // je récupère le contenu html
        $content = $response->getContent();
        // je modifie le contenu html
        $content = str_replace("</nav>", '</nav><div class="mt-3 alert alert-danger">' . $message . '</div>', $content);
        // j'envoi mon contenu modifié
        $response->setContent($content);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
