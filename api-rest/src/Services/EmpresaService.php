<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use Exception;

/**
 * Class EmpresaService
 * @package App\Services
 */
class EmpresaService
{
    /**
     * @var EmpresaRepository
     */
    private EmpresaRepository $repository;

    /**
     * EmpresaService constructor.
     * @param EmpresaRepository $repository
     */
    public function __construct(EmpresaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $json
     * @return Empresa
     * @throws Exception
     */
    public function criarEmpresa(string $json): Empresa
    {
        $dataJson = json_decode($json);

        $empresa = new Empresa();
        $empresa
            ->setRazaoSocial($dataJson->razaoSocial)
            ->setNomeFantasia($dataJson->nomeFantasia)
            ->setAtividadePrincipal($dataJson->atividadePrincipal)
            ->setCnpj($dataJson->cnpj)
            ->setSituacaoCadastral($dataJson->situacaoCadastral)
            ->setDataAbertura(new \DateTime($dataJson->dataAbertura));

        return $empresa;
    }

    /**
     * @param int $id
     * @param Empresa $empresaAux
     * @return Empresa|null
     */
    public function atualizarEmpresa(int $id, Empresa $empresaAux): ?Empresa
    {
        $empresa = $this->repository->find($id);

        if (!is_null($empresa)) {
            $empresa
                ->setRazaoSocial($empresaAux->getRazaoSocial())
                ->setNomeFantasia($empresaAux->getNomeFantasia())
                ->setAtividadePrincipal($empresaAux->getAtividadePrincipal())
                ->setCnpj($empresaAux->getCnpj())
                ->setSituacaoCadastral($empresaAux->getSituacaoCadastral())
                ->setDataAbertura($empresaAux->getDataAbertura());
        };

        return $empresa;
    }
}