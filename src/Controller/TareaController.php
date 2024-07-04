<?php

// src/Controller/TareaController.php
namespace App\Controller;

use App\Entity\Tarea;
use App\Repository\TareaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class TareaController extends AbstractController
{
    private $tareaRepository;

    public function __construct(TareaRepository $tareaRepository, EntityManagerInterface $entityManager)
    {
        $this->tareaRepository = $tareaRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_tarea')]
    public function index(): JsonResponse
    {
        return $this->json('Bienvenidos');
    }

    #[Route('/api/tareas/{fecha_inicio}/{fecha_fin}/{estado}/{dias}', methods: ['GET'], name: 'todosTareas')]
    public function todostareas(?\DateTime $fecha_inicio, ?\DateTime $fecha_fin, string $estado, int $dias): JsonResponse
    {
        // Verificar que las fechas de inicio y fin están presentes
        if (!$fecha_inicio) {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo fecha_inicio']);
        }
        if (!$fecha_fin) {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo fecha_fin']);
        }

        $tareas = $this->tareaRepository->findByDateRange($fecha_inicio, $fecha_fin, $estado);
        // return $this->json($tareas);
        if(count($tareas) > 0){
            $w_datos = [];
            foreach ($tareas as $key => $value) {
                $fechaInicioMasDosDiasHabiles = $this->sumarDiasHabiles($value['fecha_inicio'], $dias);
                $w_aux = [
                    "id" => $value['id'],
                    "descripcion" => $value['descripcion'],
                    "fecha_inicio" => $value['fecha_inicio']->format('Y-m-d'), 
                    "fecha_fin" => $fechaInicioMasDosDiasHabiles->format('Y-m-d'),
                    "dias_pasados" => $dias,
                    // "fecha_fin" => $value['fecha_fin']->format('Y-m-d'),
                    // "tiempo_estimado" => $value['tiempo_estimado'],
                    "estado" => $value['estado'],
                    "empleado_nombres_apellidos" => $value['empleado_nombres'] . '-' . $value['empleado_apellidos'],
                    "proyecto_nombre" => $value['proyecto_nombre']
                ];
                array_push($w_datos, $w_aux);
            }
            return $this->json(['error' => 0, 'mensaje' => 'Ok', 'datos' => $w_datos]);
        }
        return $this->json(['error' => 9999, 'mensaje' => 'Sin datos']);
      
    }
    private function sumarDiasHabiles(\DateTime $fecha, int $dias): \DateTime
    {
        $fechaInicio = clone $fecha;
        $diasHabiles = 0;

        while ($diasHabiles < $dias) {
            // Sumar un día a la fecha
            $fechaInicio->modify('+1 day');

            // Verificar si el día no es sábado ni domingo
            if ($fechaInicio->format('N') < 6) {
                $diasHabiles++;
            }
        }

        return $fechaInicio;
    }

}
