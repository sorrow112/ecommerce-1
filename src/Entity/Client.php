<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Payement::class, mappedBy="client")
     */
    private $payements;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="client")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=PanierAchat::class, mappedBy="client")
     */
    private $panierAchats;

    public function __construct()
    {
        $this->payements = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->panierAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Payement[]
     */
    public function getPayements(): Collection
    {
        return $this->payements;
    }

    public function addPayement(Payement $payement): self
    {
        if (!$this->payements->contains($payement)) {
            $this->payements[] = $payement;
            $payement->setClient($this);
        }

        return $this;
    }

    public function removePayement(Payement $payement): self
    {
        if ($this->payements->removeElement($payement)) {
            // set the owning side to null (unless already changed)
            if ($payement->getClient() === $this) {
                $payement->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PanierAchat[]
     */
    public function getPanierAchats(): Collection
    {
        return $this->panierAchats;
    }

    public function addPanierAchat(PanierAchat $panierAchat): self
    {
        if (!$this->panierAchats->contains($panierAchat)) {
            $this->panierAchats[] = $panierAchat;
            $panierAchat->setClient($this);
        }

        return $this;
    }

    public function removePanierAchat(PanierAchat $panierAchat): self
    {
        if ($this->panierAchats->removeElement($panierAchat)) {
            // set the owning side to null (unless already changed)
            if ($panierAchat->getClient() === $this) {
                $panierAchat->setClient(null);
            }
        }

        return $this;
    }
}
