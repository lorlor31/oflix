<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;

final class ExceptionListener
{
    #[AsEventListener(event: KernelEvents::EXCEPTION)]
    public function onKernelException(ExceptionEvent $event): void
    {
        //  vérifier que dans l'url je n'ai pas /api
        $request = $event->getRequest();
        // si jamais l'url ne commence pas par /api on stop le listener car on est sur la version fullstack du site
        if (strpos($request->getPathInfo(), "/api") !== 0) return;
        // je récupère l'erreur grâce à event
        $exception = $event->getThrowable();

        // j'initalise mes variables par défaut en partant du principe que mon erreur par défaut sera une erreur serveur
        $message = "Server error";
        $statusCode = 500;

        // si jamais on est bien sur une erreur http on remplace les variables par défaut
        if ($exception instanceof HttpException) {
            $message = $exception->getMessage();
            $statusCode = $exception->getStatusCode();
        }
        // on utilise maintenant nos variables pour renvoyer du json
        $data = [
            "statusCode" => $statusCode,
            "message" => $message
        ];

        // je crée le json
        $json = new JsonResponse($data, $statusCode);
        // je le met dans la réponse
        $event->setResponse($json);
    }
}
