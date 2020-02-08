<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Socio implements \JsonSerializable {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $nomeCompleto;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $nascimento;

    /**
     * @ORM\Column(type="string")
     */
    private $sexo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Empresa")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empresa;

    public function getId() : ?int {
        return $this->id;
    }

    public function getNomeCompleto() : ?string {
        return $this->nomeCompleto;
    }

    public function setNomeCompleto($nomeCompleto) : self {
        $this->nomeCompleto = $nomeCompleto;
        return $this;
    }

    public function getCpf() : ?string {
        return $this->cpf;
    }

    public function setCpf($cpf) : self {
        $this->cpf = $cpf;
        return $this;
    }

    public function getEmail() : ?string {
        return $this->email;
    }

    public function setEmail($email) : self {
        $this->email = $email;
        return $this;
    }

    public function getNascimento() : ?\DateTime {
        return $this->nascimento;
    }

    public function setNascimento($nascimento) : self {
        $this->nascimento = $nascimento;
        return $this;
    }

    public function getSexo() : ?string {
        return $this->sexo;
    }

    public function setSexo($sexo) : self {
        $this->sexo = $sexo;
        return $this;
    }

    public function getEmpresa() : ?Empresa {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa) : self{
        $this->empresa = $empresa;
        return $this;
    }

    public function jsonSerialize() {
        return [
            "id" => $this->getId(),
            "nomeCompleto" => $this->getNomeCompleto(),
            "cpf" => $this->getCpf(),
            "email" => $this->getEmail(),
            "sexo" => $this->getSexo(),
            "nascimento" => $this->getNascimento()->format("d/m/Y"),
            "empresaId" => $this->getEmpresa()->getId()
        ];
    }
}
