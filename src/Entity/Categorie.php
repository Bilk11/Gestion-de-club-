<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9]*$/',
        message: "Le code doit contenir des lettres et des chiffres, sans caractères spéciaux."
    )]
    private ?string $codeRacourci = null;

  
    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Licencie::class)]
    private Collection $Licencie;

    public function __construct()
    {
        $this->Licencie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodeRacourci(): ?string
    {
        return $this->codeRacourci;
    }

    public function setCodeRacourci(string $codeRacourci): static
    {
        $this->codeRacourci = $codeRacourci;

        return $this;
    }

    /**
     * @return Collection<int, Licencie>
     */
    public function getLicencie(): Collection
    {
        return $this->Licencie;
    }

    public function addLicencie(Licencie $licencie): static
    {
        if (!$this->Licencie->contains($licencie)) {
            $this->Licencie->add($licencie);
            $licencie->setCategorie($this);
        }

        return $this;
    }

    public function removeLicencie(Licencie $licencie): static
    {
        if ($this->Licencie->removeElement($licencie)) {
            // set the owning side to null (unless already changed)
            if ($licencie->getCategorie() === $this) {
                $licencie->setCategorie(null);
            }
        }

        return $this;
    }
}
