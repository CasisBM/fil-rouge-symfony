<?php

namespace App\Entity;

use App\Repository\SallesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SallesRepository::class)]
class Salles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'salles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etablissements $id_etablissement = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_salle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $caracteristique = null;

    #[ORM\OneToMany(mappedBy: 'id_salle', targetEntity: Cours::class)]
    private Collection $cours;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEtablissement(): ?Etablissements
    {
        return $this->id_etablissement;
    }

    public function setIdEtablissement(?Etablissements $id_etablissement): self
    {
        $this->id_etablissement = $id_etablissement;

        return $this;
    }

    public function getNomSalle(): ?string
    {
        return $this->nom_salle;
    }

    public function setNomSalle(string $nom_salle): self
    {
        $this->nom_salle = $nom_salle;

        return $this;
    }

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(?string $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setIdSalle($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getIdSalle() === $this) {
                $cour->setIdSalle(null);
            }
        }

        return $this;
    }
}
