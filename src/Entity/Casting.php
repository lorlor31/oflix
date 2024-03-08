<?php

namespace App\Entity;

use App\Repository\CastingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CastingRepository::class)]
class Casting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['castingLinked'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['castingLinked'])]
    private ?string $role = null;

    #[ORM\Column]
    #[Groups(['castingLinked'])]
    private ?int $creditOrder = null;

    #[ORM\ManyToOne(inversedBy: 'castings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?show $show = null;

    #[ORM\ManyToOne(inversedBy: 'castings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Person $person = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getCreditOrder(): ?int
    {
        return $this->creditOrder;
    }

    public function setCreditOrder(int $creditOrder): static
    {
        $this->creditOrder = $creditOrder;

        return $this;
    }

    public function getShow(): ?show
    {
        return $this->show;
    }

    public function setShow(?show $show): static
    {
        $this->show = $show;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        $this->person = $person;

        return $this;
    }
}
