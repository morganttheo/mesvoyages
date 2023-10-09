<?php

namespace App\Entity;

use App\Repository\EnvironnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnvironnementRepository::class)
 */
class Environnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Visite::class, mappedBy="environnements")
     */
    private $a;

    public function __construct()
    {
        $this->a = new ArrayCollection();
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

    /**
     * @return Collection<int, Visite>
     */
    public function getA(): Collection
    {
        return $this->a;
    }

    public function addA(Visite $a): self
    {
        if (!$this->a->contains($a)) {
            $this->a[] = $a;
            $a->addEnvironnement($this);
        }

        return $this;
    }

    public function removeA(Visite $a): self
    {
        if ($this->a->removeElement($a)) {
            $a->removeEnvironnement($this);
        }

        return $this;
    }
}
