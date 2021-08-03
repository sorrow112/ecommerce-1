<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
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
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_livraison;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="float")
     */
    private $monstant;

    /**
     * @ORM\ManyToOne(targetEntity=adresse::class, inversedBy="commandes")
     */
    private $address;



    /**
     * @ORM\OneToOne(targetEntity=payement::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $payement;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="commandes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(\DateTimeInterface $date_livraison): self
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getMonstant(): ?float
    {
        return $this->monstant;
    }

    public function setMonstant(float $monstant): self
    {
        $this->monstant = $monstant;

        return $this;
    }

    public function getAddress(): ?adresse
    {
        return $this->address;
    }

    public function setAddress(?adresse $address): self
    {
        $this->address = $address;

        return $this;
    }



    public function getPayement(): ?payement
    {
        return $this->payement;
    }

    public function setPayement(payement $payement): self
    {
        $this->payement = $payement;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
