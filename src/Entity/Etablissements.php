<?php

namespace App\Entity;

use App\Repository\EtablissementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementsRepository::class)]
class Etablissements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_etablissement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville = null;

    #[ORM\OneToMany(mappedBy: 'id_etablissement', targetEntity: Promotions::class, orphanRemoval: true)]
    private Collection $promotions;

    #[ORM\OneToMany(mappedBy: 'id_etablissement', targetEntity: Salles::class)]
    private Collection $salles;

    public function __construct()
    {
        $this->promotions = new ArrayCollection();
        $this->salles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nom_etablissement;
    }

    public function setNomEtablissement(string $nom_etablissement): self
    {
        $this->nom_etablissement = $nom_etablissement;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Promotions>
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotions $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions->add($promotion);
            $promotion->setIdEtablissement($this);
        }

        return $this;
    }

    public function removePromotion(Promotions $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getIdEtablissement() === $this) {
                $promotion->setIdEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Salles>
     */
    public function getSalles(): Collection
    {
        return $this->salles;
    }

    public function addSalle(Salles $salle): self
    {
        if (!$this->salles->contains($salle)) {
            $this->salles->add($salle);
            $salle->setIdEtablissement($this);
        }

        return $this;
    }

    public function removeSalle(Salles $salle): self
    {
        if ($this->salles->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getIdEtablissement() === $this) {
                $salle->setIdEtablissement(null);
            }
        }

        return $this;
    }
}
