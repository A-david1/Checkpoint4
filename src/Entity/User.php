<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=ReadingList::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $readingList;

    /**
     * @ORM\OneToMany(targetEntity=PersonalList::class, mappedBy="user")
     */
    private $personalLists;

    public function __construct()
    {
        $this->personalLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReadingList(): ?ReadingList
    {
        return $this->readingList;
    }

    public function setReadingList(?ReadingList $readingList): self
    {
        // unset the owning side of the relation if necessary
        if ($readingList === null && $this->readingList !== null) {
            $this->readingList->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($readingList !== null && $readingList->getUser() !== $this) {
            $readingList->setUser($this);
        }

        $this->readingList = $readingList;

        return $this;
    }

    /**
     * @return Collection|PersonalList[]
     */
    public function getPersonalLists(): Collection
    {
        return $this->personalLists;
    }

    public function addPersonalList(PersonalList $personalList): self
    {
        if (!$this->personalLists->contains($personalList)) {
            $this->personalLists[] = $personalList;
            $personalList->setUser($this);
        }

        return $this;
    }

    public function removePersonalList(PersonalList $personalList): self
    {
        if ($this->personalLists->removeElement($personalList)) {
            // set the owning side to null (unless already changed)
            if ($personalList->getUser() === $this) {
                $personalList->setUser(null);
            }
        }

        return $this;
    }
}
