<?php

namespace App\Repository;

use App\Entity\Socio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class SocioRepository
 * @package App\Repository
 * @method Socio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Socio[]    findAll()
 */
class SocioRepository extends ServiceEntityRepository
{
    /**
     * SocioRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Socio::class);
    }

    /**
     * @param int $empresaId
     * @return array
     */
    public function buscarPorEmpresa(int $empresaId): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager
            ->createQuery(
                'SELECT s, e FROM App\Entity\Socio s JOIN s.empresa e WHERE s.empresa = :empresaId ORDER BY s.nomeCompleto ASC'
            )
            ->setParameter('empresaId', $empresaId);

        return $query->getResult();
    }
}