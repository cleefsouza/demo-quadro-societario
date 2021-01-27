<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * Class Socio
 * @package App\Entity
 */
class Socio implements \JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $nomeCompleto;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     * @var string
     */
    private string $cpf;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $email;

    /**
     * @ORM\Column(type="date")
     * @var DateTime
     */
    private DateTime $nascimento;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $sexo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Empresa")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @var Empresa
     */
    private Empresa $empresa;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getNomeCompleto(): ?string
    {
        return $this->nomeCompleto;
    }

    /**
     * @param $nomeCompleto
     * @return $this
     */
    public function setNomeCompleto(string $nomeCompleto): self
    {
        $this->nomeCompleto = $nomeCompleto;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    /**
     * @param $cpf
     * @return $this
     */
    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getNascimento(): ?DateTime
    {
        return $this->nascimento;
    }

    /**
     * @param $nascimento
     * @return $this
     */
    public function setNascimento(DateTime $nascimento): self
    {
        $this->nascimento = $nascimento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    /**
     * @param $sexo
     * @return $this
     */
    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * @return Empresa|null
     */
    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    /**
     * @param Empresa|null $empresa
     * @return $this
     */
    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
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
