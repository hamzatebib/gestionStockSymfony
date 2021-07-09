<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
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
    private $label;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoface;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoprofil;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;
    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="produits")
     */
    private $fournisseur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPhotoface(): ?string
    {
        return $this->photoface;
    }

    public function setPhotoface(string $photoface): self
    {
        $this->photoface = $photoface;

        return $this;
    }

    public function getPhotoprofil(): ?string
    {
        return $this->photoprofil;
    }

    public function setPhotoprofil(string $photoprofil): self
    {
        $this->photoprofil = $photoprofil;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }
}
