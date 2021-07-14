<?php

namespace App\Entity;

use App\Repository\PayementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PayementRepository::class)
 */
class Payement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_pay;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity=client::class, inversedBy="payements")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePay(): ?\DateTimeInterface
    {
        return $this->date_pay;
    }

    public function setDatePay(\DateTimeInterface $date_pay): self
    {
        $this->date_pay = $date_pay;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
