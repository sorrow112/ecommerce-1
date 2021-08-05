<?php

namespace App\Entity;

use App\Repository\PanierAchatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierAchatRepository::class)
 */
class PanierAchat
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
    private $date_de_creation;



    /**
     * @ORM\OneToOne(targetEntity=commande::class, cascade={"persist", "remove"})
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="panierAchats")
     */
    private $user;

    /**
     * @ORM\Column(type="json")
     */
    private $produits = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeCreation(): ?\DateTimeInterface
    {
        return $this->date_de_creation;
    }

    public function setDateDeCreation(\DateTimeInterface $date_de_creation): self
    {
        $this->date_de_creation = $date_de_creation;

        return $this;
    }



    public function getCommande(): ?commande
    {
        return $this->commande;
    }

    public function setCommande(?commande $commande): self
    {
        $this->commande = $commande;

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

    public function getProduits(): ?array
    {
        return $this->produits;
    }

    public function setProduits(array $produits): self
    {
        $this->produits = $produits;

        return $this;
    }
}
