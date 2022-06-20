<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Enum\Gender;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;


#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const ROLE_ADMIN = "ROLE_ADMIN";
    const ROLE_USER = "ROLE_USER";

    #[ORM\Id]
    #[ORM\GeneratedValue('CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid', length: 96, unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 200, unique: true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string')]
    private string $firstName;

    #[ORM\Column(type: 'string')]
    private string $lastName;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: Scope::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $scopes;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'concernedUser')]
    private $events;

    #[ORM\ManyToMany(targetEntity: EventInvitation::class, mappedBy: 'recipient')]
    private $eventInvitations;

    #[ORM\Column(type: 'string', enumType: Gender::class)]
    private Gender $genre;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->scopes = new ArrayCollection();
        $this->eventInvitations = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
        return $this->id;
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
     * @see PasswordAuthenticatedUserInterface
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

    public function getGenre(): Gender
    {
        return $this->genre;
    }

    public function setGenre(Gender $genre): User
    {
        $this->genre = $genre;

        return $this;
    }

    public function eraseCredentials()
    {

    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addConcernedUser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            $event->removeConcernedUser($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getScopes(): Collection
    {
        return $this->scopes;
    }

    public function addScope(Scope $scope): self
    {
        if (!$this->scopes->contains($scope)) {
            $this->scopes[] = $scope;
            $scope->setUser($this);
        }

        return $this;
    }

    public function removeScope(Scope $scope): self
    {
        if ($this->events->removeElement($scope)) {
            if ($scope->getUser() === $this) {
                $scope->setUser(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, EventInvitation>
     */
    public function getEventInvitations(): Collection
    {
        return $this->eventInvitations;
    }

    public function addEventInvitation(EventInvitation $eventInvitation): self
    {
        if (!$this->eventInvitations->contains($eventInvitation)) {
            $this->eventInvitations[] = $eventInvitation;
            $eventInvitation->addRecipient($this);
        }

        return $this;
    }

    public function removeEventInvitation(EventInvitation $eventInvitation): self
    {
        if ($this->eventInvitations->removeElement($eventInvitation)) {
            $eventInvitation->removeRecipient($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    public function getFullName(): string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }


}
