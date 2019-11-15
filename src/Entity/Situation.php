<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SituationRepository")
 */
class Situation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Professionnelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Entreprise;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="situations")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfessionnelle(): ?string
    {
        return $this->Professionnelle;
    }

    public function setProfessionnelle(string $Professionnelle): self
    {
        $this->Professionnelle = $Professionnelle;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->Entreprise;
    }

    public function setEntreprise(string $Entreprise): self
    {
        $this->Entreprise = $Entreprise;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $users): self
    {
        if (!$this->users->contains($users)) {
            $this->users[] = $users;
            $users->addSituation($this);
        }

        return $this;
    }

    public function removeUser(User $users): self
    {
        if ($this->users->contains($users)) {
            $this->users->removeElement($users);
            $users->removeSituation($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Professionnelle;
    }
}
