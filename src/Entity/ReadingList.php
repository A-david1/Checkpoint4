<?php

namespace App\Entity;

use App\Repository\ReadingListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReadingListRepository::class)
 */
class ReadingList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="startedAt", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $startedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $addedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $finishedAt;

    /**
     * @ORM\OneToMany(targetEntity=ReadingStatus::class, mappedBy="readingList")
     */
    private $readingStatuses;

    public function __construct()
    {
        $this->readingStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTimeImmutable $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getAddedAt(): ?\DateTimeImmutable
    {
        return $this->addedAt;
    }

    public function setAddedAt(?\DateTimeImmutable $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    public function getFinishedAt(): ?\DateTimeImmutable
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(?\DateTimeImmutable $finishedAt): self
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    /**
     * @return Collection|ReadingStatus[]
     */
    public function getReadingStatuses(): Collection
    {
        return $this->readingStatuses;
    }

    public function addReadingStatus(ReadingStatus $readingStatus): self
    {
        if (!$this->readingStatuses->contains($readingStatus)) {
            $this->readingStatuses[] = $readingStatus;
            $readingStatus->setReadingList($this);
        }

        return $this;
    }

    public function removeReadingStatus(ReadingStatus $readingStatus): self
    {
        if ($this->readingStatuses->removeElement($readingStatus)) {
            // set the owning side to null (unless already changed)
            if ($readingStatus->getReadingList() === $this) {
                $readingStatus->setReadingList(null);
            }
        }

        return $this;
    }
}
