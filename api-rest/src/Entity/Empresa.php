<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * Class Empresa
 * @package App\Entity
 */
class Empresa implements \JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $razaoSocial;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $nomeFantasia;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $atividadePrincipal;

    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    private string $cnpj;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var bool
     */
    private bool $situacaoCadastral;

    /**
     * @ORM\Column(type="date")
     * @var DateTime
     */
    private DateTime $dataAbertura;

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
    public function getRazaoSocial(): ?string
    {
        return $this->razaoSocial;
    }

    /**
     * @param $razaoSocial
     * @return $this
     */
    public function setRazaoSocial(string $razaoSocial): self
    {
        $this->razaoSocial = $razaoSocial;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomeFantasia(): ?string
    {
        return $this->nomeFantasia;
    }

    /**
     * @param $nomeFantasia
     * @return $this
     */
    public function setNomeFantasia(string $nomeFantasia): self
    {
        $this->nomeFantasia = $nomeFantasia;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAtividadePrincipal(): ?string
    {
        return $this->atividadePrincipal;
    }

    /**
     * @param $atividadePrincipal
     * @return $this
     */
    public function setAtividadePrincipal(string $atividadePrincipal): self
    {
        $this->atividadePrincipal = $atividadePrincipal;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    /**
     * @param $cnpj
     * @return $this
     */
    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSituacaoCadastral(): ?bool
    {
        return $this->situacaoCadastral;
    }

    /**
     * @param $situacaoCadastral
     * @return $this
     */
    public function setSituacaoCadastral(bool $situacaoCadastral): self
    {
        $this->situacaoCadastral = $situacaoCadastral;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataAbertura(): ?DateTime
    {
        return $this->dataAbertura;
    }

    /**
     * @param $dataAbertura
     * @return $this
     */
    public function setDataAbertura(DateTime $dataAbertura): self
    {
        $this->dataAbertura = $dataAbertura;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            "id" => $this->getId(),
            "razaoSocial" => $this->getRazaoSocial(),
            "nomeFantasia" => $this->getNomeFantasia(),
            "cnpj" => $this->getCnpj(),
            "atividadePrincipal" => $this->getAtividadePrincipal(),
            "dataAbertura" => $this->getDataAbertura()->format("d/m/Y"),
            "situacaoCadastral" => $this->getSituacaoCadastral()
        ];
    }
}
