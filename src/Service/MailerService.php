<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailerService
{

    // en faisant ça, je rend mon service MailerService dépendant, du Mailer de symfony
    // ! DEPENDENCY INJECTION
    // * équivalent avant php 8
    // private $mailer;
    // public function __construct(MailerInterface $mailer)
    // {
    //     $this->mailer = $mailer;
    // }
    public function __construct(
        private MailerInterface $mailer,
        private $ownerMail
    ) {
    }

    public function send(string $subject, ?string $twigFile = null, ?array $data = null)
    {
        $email = (new TemplatedEmail())
            ->from($this->ownerMail)
            ->to($this->ownerMail)
            ->subject($subject)
            ->htmlTemplate($twigFile)
            ->context($data);

        $this->mailer->send($email);
    }
}
