<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Socio;
use App\Repository\{EmpresaRepository, SocioRepository};
use Exception;

/**
 * Class SocioService
 * @package App\Services
 */
class SocioService
{
    /**
     * @var SocioRepository
     */
    private SocioRepository $repository;
    /**
     * @var EmpresaRepository
     */
    private EmpresaRepository $empresaRepository;

    /**
     * SocioService constructor.
     * @param SocioRepository $repository
     * @param EmpresaRepository $empresaRepository
     */
    public function __construct(
        SocioRepository $repository,
        EmpresaRepository $empresaRepository
    ) {
        $this->repository = $repository;
        $this->empresaRepository = $empresaRepository;
    }

    /**
     * @param string $json
     * @return Socio
     * @throws Exception
     */
    public function criarSocio(string $json): Socio
    {
        $dataJson = json_decode($json);
        $empresaId = $dataJson->empresaId;
        $empresa = $this->empresaRepository->find($empresaId);

        $socio = new Socio();
        $socio
            ->setNomeCompleto($dataJson->nomeCompleto)
            ->setCpf($dataJson->cpf)
            ->setEmail($dataJson->email)
            ->setNascimento(new \DateTime($dataJson->nascimento))
            ->setSexo($dataJson->sexo)
            ->setEmpresa($empresa);

        return $socio;
    }

    /**
     * @param int $id
     * @param Socio $socioAux
     * @return Socio|null
     */
    public function atualizarSocio(int $id, Socio $socioAux): ?Socio
    {
        $socio = $this->repository->find($id);

        if (!is_null($socio)) {
            $socio
                ->setNomeCompleto($socioAux->getNomeCompleto())
                ->setCpf($socioAux->getCpf())
                ->setEmail($socioAux->getEmail())
                ->setSexo($socioAux->getSexo())
                ->setNascimento($socioAux->getNascimento())
                ->setEmpresa($socioAux->getEmpresa());
        };

        return $socio;
    }
}