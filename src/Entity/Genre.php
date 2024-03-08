<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
#[UniqueConstraint(name: "unique_name", columns: ["name"])]
#[Groups(['genre'])]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['genreLinked'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['genreLinked'])]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Show::class, mappedBy: 'genres')]
    private Collection $shows;

    public function __construct()
    {
        $this->shows = new ArrayCollection();
    }

    // Pour pouvoir afficher sans faire de choice_label :
    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Show>
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(Show $show): static
    {
        if (!$this->shows->contains($show)) {
            $this->shows->add($show);

            // rajouté par le maker pour que Doctrine puisse faire la mise à jour
            $show->addGenre($this);
        }

        return $this;
    }

    public function removeShow(Show $show): static
    {
        if ($this->shows->removeElement($show)) {
            $show->removeGenre($this);
        }

        return $this;
    }
}

/**
 * #[ORM\Column(length: 50)]
	#[Groups(['genreLinked'])]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
	#[Groups(['genreLinked'])]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
	#[Groups(['genreLinked'])]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
	#[Groups(['genreLinked'])]
    private ?float $rating;

    #[ORM\Column]
	#[Groups(['genreLinked'])]
    private array $reactions = [];

    #[ORM\Column]
	#[Groups(['genreLinked'])]
    private ?\DateTimeImmutable $watchedAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Show $movie = null;
 */
