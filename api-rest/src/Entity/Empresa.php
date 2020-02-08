<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Empresa implements \JsonSerializable {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $razaoSocial;

    /**
     * @ORM\Column(type="string")
     */
    private $nomeFantasia;

    /**
     * @ORM\Column(type="string")
     */
    private $atividadePrincipal;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $cnpj;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $situacaoCadastral;

    /**
     * @ORM\Column(type="date")
     */
    private $dataAbertura;

    public function getId() : ?int {
        return $this->id;
    }

    public function getRazaoSocial() : ?string {
        return $this->razaoSocial;
    }

    public function setRazaoSocial($razaoSocial) : self {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }

    public function getNomeFantasia() : ?string {
        return $this->nomeFantasia;
    }

    public function setNomeFantasia($nomeFantasia) : self {
        $this->nomeFantasia = $nomeFantasia;
        return $this;
    }

    public function getAtividadePrincipal() : ?string {
        return $this->atividadePrincipal;
    }

    public function setAtividadePrincipal($atividadePrincipal) : self {
        $this->atividadePrincipal = $atividadePrincipal;
        return $this;
    }

    public function getCnpj() : ?string {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) : self {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getSituacaoCadastral() : ?bool {
        return $this->situacaoCadastral;
    }

    public function setSituacaoCadastral($situacaoCadastral) : self {
        $this->situacaoCadastral = $situacaoCadastral;
        return $this;
    }

    public function getDataAbertura() : ?\DateTime{
        return $this->dataAbertura;
    }

    public function setDataAbertura($dataAbertura) : self {
        $this->dataAbertura = $dataAbertura;
        return $this;
    }

    public function jsonSerialize() {
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
