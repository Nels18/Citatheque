<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'json')]
    private $role = [];

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $updatedAt;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Report::class)]
    private $reports;

    #[ORM\ManyToMany(targetEntity: Quote::class, mappedBy: 'user')]
    private $quotes;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Quote::class)]
    private $createdQuotes;

    public function __construct()
    {
        $this->reports = new ArrayCollection();
        $this->quotes = new ArrayCollection();
        $this->createdQuotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Report[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->setUser($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->removeElement($report)) {
            // set the owning side to null (unless already changed)
            if ($report->getUser() === $this) {
                $report->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Quote[]
     */
    public function getQuotes(): Collection
    {
        return $this->quotes;
    }

    public function addQuote(Quote $quote): self
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes[] = $quote;
            $quote->addUser($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->removeElement($quote)) {
            $quote->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Quote[]
     */
    public function getCreatedQuotes(): Collection
    {
        return $this->createdQuotes;
    }

    public function addCreatedQuote(Quote $createdQuote): self
    {
        if (!$this->createdQuotes->contains($createdQuote)) {
            $this->createdQuotes[] = $createdQuote;
            $createdQuote->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCreatedQuote(Quote $createdQuote): self
    {
        if ($this->createdQuotes->removeElement($createdQuote)) {
            // set the owning side to null (unless already changed)
            if ($createdQuote->getCreatedBy() === $this) {
                $createdQuote->setCreatedBy(null);
            }
        }

        return $this;
    }
}
