<?php

namespace App\Entity;

use App\Repository\SolicitudRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SolicitudRepository::class)]
class Solicitud
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fechaInicio;

    #[ORM\Column(type: 'date')]
    private $fechafin;

    #[ORM\Column(type: 'integer')]
    private $numPaquetes;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'solicitudes')]
    #[ORM\JoinColumn(nullable: false)]
    private $Repartidor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechafin(): ?\DateTimeInterface
    {
        return $this->fechafin;
    }

    public function setFechafin(\DateTimeInterface $fechafin): self
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    public function getNumPaquetes(): ?int
    {
        return $this->numPaquetes;
    }

    public function setNumPaquetes(int $numPaquetes): self
    {
        $this->numPaquetes = $numPaquetes;

        return $this;
    }

    public function getRepartidor(): ?User
    {
        return $this->Repartidor;
    }

    public function setRepartidor(?User $Repartidor): self
    {
        $this->Repartidor = $Repartidor;

        return $this;
    }
}
