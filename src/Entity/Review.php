<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[Groups(['review'])]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['reviewLinked'])]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['reviewLinked'])]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['reviewLinked'])]
    private ?string $email = null;

    // ! exemple de contraintes de validations
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2
    )]
    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['reviewLinked'])]
    private ?string $content = null;

    #[ORM\Column]
    #[Groups(['reviewLinked'])]
    private ?int $rating = null;

    #[ORM\Column]
    #[Groups(['reviewLinked'])]
    private array $reactions = [];

    #[ORM\Column]
    #[Groups(['reviewLinked'])]
    private ?\DateTimeImmutable $watchedAt = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Show $movie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getReactions(): array
    {
        return $this->reactions;
    }

    public function setReactions(array $reactions): static
    {
        $this->reactions = $reactions;

        return $this;
    }

    public function getWatchedAt(): ?\DateTimeImmutable
    {
        return $this->watchedAt;
    }

    public function setWatchedAt(\DateTimeImmutable $watchedAt): static
    {
        $this->watchedAt = $watchedAt;

        return $this;
    }

    public function getMovie(): ?Show
    {
        return $this->movie;
    }

    public function setMovie(?Show $movie): static
    {
        $this->movie = $movie;

        return $this;
    }
}
