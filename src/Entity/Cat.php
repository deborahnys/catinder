<?php

namespace App\Entity;

use App\Controller\UserLikeCatController;
use App\Repository\CatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CatRepository::class)]
class Cat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'cats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\ManyToOne(inversedBy: 'cats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Color $color = null;

    #[ORM\Column(length: 255)]
    private ?string $localisation = null;

    #[ORM\Column(length: 500)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'cats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'cat_id', targetEntity: UserLikeCat::class, orphanRemoval: true)]
    private Collection $userLikeCats;




    public function __construct()
    {
        $this->userLikeCats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): static
    {
        $this->race = $race;
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, UserLikeCat>
     */
    public function getUserLikeCats(): Collection
    {
        return $this->userLikeCats;
    }

    public function addUserLikeCat(UserLikeCat $userLikeCat): static
    {
        if (!$this->userLikeCats->contains($userLikeCat)) {
            $this->userLikeCats->add($userLikeCat);
            $userLikeCat->setCat($this);
        }

        return $this;
    }

    public function removeUserLikeCat(UserLikeCat $userLikeCat): static
    {
        if ($this->userLikeCats->removeElement($userLikeCat)) {
            // set the owning side to null (unless already changed)
            if ($userLikeCat->getCat() === $this) {
                $userLikeCat->setCat(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->name;
    }
}
