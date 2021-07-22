<?php

namespace App\Entity;

use App\Repository\ReadingStatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReadingStatusRepository::class)
 */
class ReadingStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ReadingList::class, inversedBy="readingStatuses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $readingList;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Book;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReadingList(): ?ReadingList
    {
        return $this->readingList;
    }

    public function setReadingList(?ReadingList $readingList): self
    {
        $this->readingList = $readingList;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->Book;
    }

    public function setBook(?Book $Book): self
    {
        $this->Book = $Book;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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
     * Gets triggered only on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->startedAt = new \DateTimeImmutable();
        $this->addedAt = new \DateTimeImmutable();
        $this->finishedAt = new \DateTimeImmutable();
    }

    /**
     * Gets triggered only on update
     * @ORM\PreUpdate()
     */
    public function onPreUpdate()
    {
        $this->startedAt = new \DateTimeImmutable();
        $this->finishedAt = new \DateTimeImmutable();
    }
}
