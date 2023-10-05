<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;



#[UniqueEntity('email')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\EntityListeners(['App\EntityListener\UserListener'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 4, max: 50)]
    private ?string $Pseudo = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email]
    #[Assert\Length(min: 4, max: 180)]
    private ?string $email = null;

    #[ORM\Column]

    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Assert\NotBlank(groups: ['registration'])]
    private ?string $plainPassword = null;

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 255)]
    private ?string $localisation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 4, max: 255)]
    private ?string $picture = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Cat::class)]
    private Collection $cats;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: UserLikeCat::class, orphanRemoval: true)]
    private Collection $userLikeCats;


    public function __construct()
    {
        $this->userLikeCats = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Pseudo;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): static
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the hashed password
     *
     * @return  string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the hashed password
     *
     * @param  string  $plainPassword  The hashed password
     *
     * @return  self
     */
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Cat>
     */
    public function getCats(): Collection
    {
        return $this->cats;
    }

    public function addCat(Cat $cat): static
    {
        if (!$this->cats->contains($cat)) {
            $this->cats->add($cat);
            $cat->setUser($this);
        }

        return $this;
    }

    public function removeCat(Cat $cat): static
    {
        if ($this->cats->removeElement($cat)) {
            // set the owning side to null (unless already changed)
            if ($cat->getUser() === $this) {
                $cat->setUser(null);
            }
        }

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
            $userLikeCat->setUser($this);
        }

        return $this;
    }

    public function removeUserLikeCat(UserLikeCat $userLikeCat): static
    {
        if ($this->userLikeCats->removeElement($userLikeCat)) {
            // set the owning side to null (unless already changed)
            if ($userLikeCat->getUser() === $this) {
                $userLikeCat->setUser(null);
            }
        }

        return $this;
    }
}
