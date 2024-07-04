<?php

namespace App\Repository;

use App\Entity\Tarea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tarea>
 */
class TareaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarea::class);
    }

    //    /**
    //     * @return Tarea[] Returns an array of Tarea objects
    //     */
        public function findByDateRange(\DateTime $fecha_inicio, \DateTime $fecha_fin, string $estado = 'In progress'): array
        {
            return $this->createQueryBuilder('t')
                ->select(
                    't.id',
                    't.descripcion',
                    't.fecha_inicio',
                    't.fecha_fin',
                    't.tiempo_estimado',
                    't.estado',
                    'e.id as empleado_id',
                    'e.nombres as empleado_nombres',
                    'e.apellidos as empleado_apellidos',
                    'p.id as proyecto_id',
                    'p.nombre as proyecto_nombre'
                )
                ->innerJoin('t.empleado', 'e')
                ->innerJoin('t.proyecto', 'p')
                ->where('t.fecha_inicio >= :fecha_inicio')
                ->andWhere('t.fecha_inicio <= :fecha_fin')
                ->andWhere('t.estado <= :estado')
                ->setParameter('fecha_inicio', $fecha_inicio)
                ->setParameter('fecha_fin', $fecha_fin)
                ->setParameter('estado', $estado)
                ->orderBy('t.fecha_inicio', 'ASC')
                ->getQuery()
                ->getResult();
        }
    //    public function findOneBySomeField($value): ?Tarea
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
