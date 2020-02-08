<?php


namespace App\Services;


use App\Entity\Socio;
use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use App\Repository\SocioRepository;

class SocioService {

    /**
     * @var SocioRepository
     */
    private $repository;
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    public function __construct (
        SocioRepository $repository,
        EmpresaRepository $empresaRepository
    ) {
        $this->repository = $repository;
        $this->empresaRepository = $empresaRepository;
    }

    public function criarSocio(string $json) : Socio {

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

    public function atualizarSocio(int $id, Socio $socioAux) : ?Socio {

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