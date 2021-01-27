<?php

namespace App\Repository;

use App\Entity\Empresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class EmpresaRepository
 * @package App\Repository
 * @method Empresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Empresa[]    findAll()
 */
class EmpresaRepository extends ServiceEntityRepository
{
    /**
     * EmpresaRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empresa::class);
    }
}