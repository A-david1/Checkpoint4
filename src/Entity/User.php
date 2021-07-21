<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"mail"}, message="There is already an account with this mail")
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
    private $mail;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->mail;
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
