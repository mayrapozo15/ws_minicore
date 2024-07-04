<?php
// src/Entity/Proyecto.php
namespace App\Entity;

use App\Repository\ProyectoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProyectoRepository::class)]
class Proyecto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'bigint', nullable: false)]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $nombre;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
}
