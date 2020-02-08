<?php


namespace App\Services;


use App\Entity\Empresa;
use App\Repository\EmpresaRepository;

class EmpresaService {

    /**
     * @var EmpresaRepository
     */
    private $repository;

    public function __construct (EmpresaRepository $repository) {
        $this->repository = $repository;
    }

    public function criarEmpresa(string $json) : Empresa {

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

    public function atualizarEmpresa(int $id, Empresa $empresaAux) : ?Empresa {

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