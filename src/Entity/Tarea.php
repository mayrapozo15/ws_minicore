<?php

// src/Entity/Tarea.php
namespace App\Entity;

use App\Repository\TareaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TareaRepository::class)]
class Tarea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'bigint', nullable: false)]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Empleado::class)]
    #[ORM\JoinColumn(name: 'empleado', referencedColumnName: 'id')]
    private ?Empleado $empleado;

    #[ORM\ManyToOne(targetEntity: Proyecto::class)]
    #[ORM\JoinColumn(name: 'proyecto', referencedColumnName: 'id')]
    private ?Proyecto $proyecto;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private ?string $descripcion;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $fecha_inicio;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $fecha_fin;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $tiempo_estimado;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $estado;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmpleado(): ?Empleado
    {
        return $this->empleado;
    }

    public function setEmpleado(?Empleado $empleado): self
    {
        $this->empleado = $empleado;

        return $this;
    }

    public function getProyecto(): ?Proyecto
    {
        return $this->proyecto;
    }

    public function setProyecto(?Proyecto $proyecto): self
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(?\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getTiempoEstimado(): ?int
    {
        return $this->tiempo_estimado;
    }

    public function setTiempoEstimado(?int $tiempo_estimado): self
    {
        $this->tiempo_estimado = $tiempo_estimado;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
