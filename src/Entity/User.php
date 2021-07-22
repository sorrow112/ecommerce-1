<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ["client"];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="user")
     */
    private $adresses;

    /**
     * @ORM\OneToMany(targetEntity=Payement::class, mappedBy="user")
     */
    private $payements;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="user")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=PanierAchat::class, mappedBy="user")
     */
    private $panierAchats;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active = 1;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;




    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->payements = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->panierAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        if($this->password==null){
            return "";
        }
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setUser($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getUser() === $this) {
                $adress->setUser(null);
            }
        }

        return $this;
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
            $payement->setUser($this);
        }

        return $this;
    }

    public function removePayement(Payement $payement): self
    {
        if ($this->payements->removeElement($payement)) {
            // set the owning side to null (unless already changed)
            if ($payement->getUser() === $this) {
                $payement->setUser(null);
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
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
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
            $panierAchat->setUser($this);
        }

        return $this;
    }

    public function removePanierAchat(PanierAchat $panierAchat): self
    {
        if ($this->panierAchats->removeElement($panierAchat)) {
            // set the owning side to null (unless already changed)
            if ($panierAchat->getUser() === $this) {
                $panierAchat->setUser(null);
            }
        }

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }


//    public function getBirthdate(): ?\DateTimeInterface
//    {
//        return $this->birthdate;
//    }
//
//    public function setBirthdate(\DateTimeInterface $dateNaiss): self
//    {
//        $this->birthdate = $birthdate;
//
//        return $this;
//    }

public function getBirthdate(): ?\DateTimeInterface
{
    return $this->birthdate;
}

public function setBirthdate(\DateTimeInterface $birthdate): self
{
    $this->birthdate = $birthdate;

    return $this;
}
}
