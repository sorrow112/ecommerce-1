<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @Vich\Uploadable()
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantit;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="produit", cascade="persist")
     */
    private $documents;


    /**
     * @ORM\ManyToOne(targetEntity=SousCategorie::class, inversedBy="produits")
     */
    private $sous_categorie;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->updatedAt = new \DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getQuantit(): ?int
    {
        return $this->quantit;
    }

    public function setQuantit(int $quantit): self
    {
        $this->quantit = $quantit;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

//    /**
//     * @return Collection|Document[]
//     */
//    public function getDocuments(): Collection
//    {
//        return $this->documents;
//    }
//
//    public function addDocument(Document $document): self
//    {
//
//        if (!$this->documents->contains($document)) {
//            $this->documents[] = $document;
//            $document->setProduit($this);
//        }
//
//        return $this;
//    }

//    public function removeDocument(Document $document): self
//    {
//        if ($this->documents->removeElement($document)) {
//            // set the owning side to null (unless already changed)
//            if ($document->getProduit() === $this) {
//                $document->setProduit(null);
//            }
//        }
//
//        return $this;
//    }

    public function getSousCategorie(): ?SousCategorie
    {
        return $this->sous_categorie;
    }

//    public function setSousCategorie(?SousCategorie $sous_categorie): self
//    {
//        $this->sous_categorie = $sous_categorie;
//
//        return $this;
//    }

public function getUpdatedAt(): ?\DateTimeInterface
{
    return $this->updatedAt;
}

public function setUpdatedAt(\DateTimeInterface $updatedAt): self
{
    $this->updatedAt = $updatedAt;

    return $this;
}

public function setSousCategorie(?SousCategorie $sous_categorie): self
{
    $this->sous_categorie = $sous_categorie;

    return $this;
}

/**
 * @return Collection|Document[]
 */
public function getDocuments(): Collection
{
    return $this->documents;
}

public function addDocument(Document $document): self
{
    if (!$this->documents->contains($document)) {
        $this->documents[] = $document;
        $document->setProduit($this);
    }

    return $this;
}

public function removeDocument(Document $document): self
{
    if ($this->documents->removeElement($document)) {
        // set the owning side to null (unless already changed)
        if ($document->getProduit() === $this) {
            $document->setProduit(null);
        }
    }

    return $this;
}
}
