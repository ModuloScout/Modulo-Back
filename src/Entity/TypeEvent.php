<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TypeEventRepository::class)]
#[ApiResource]
class TypeEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue('CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid', length: 96, unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isObligated;

    #[ORM\OneToMany(mappedBy: 'typeEvent', targetEntity: Event::class)]
    private $events;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isActive;

    #[ORM\OneToMany(mappedBy: 'typeEvent', targetEntity: TypeEventAuthorization::class)]
    private $typeEventAuthorizations;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->typeEventAuthorizations = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsObligated(): ?bool
    {
        return $this->isObligated;
    }

    public function setIsObligated(bool $isObligated): self
    {
        $this->isObligated = $isObligated;

        return $this;
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
            $event->setTypeEvent($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getTypeEvent() === $this) {
                $event->setTypeEvent(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, TypeEventAuthorization>
     */
    public function getTypeEventAuthorizations(): Collection
    {
        return $this->typeEventAuthorizations;
    }

    public function addTypeEventAuthorization(TypeEventAuthorization $typeEventAuthorization): self
    {
        if (!$this->typeEventAuthorizations->contains($typeEventAuthorization)) {
            $this->typeEventAuthorizations[] = $typeEventAuthorization;
            $typeEventAuthorization->setTypeEvent($this);
        }

        return $this;
    }

    public function removeTypeEventAuthorization(TypeEventAuthorization $typeEventAuthorization): self
    {
        if ($this->typeEventAuthorizations->removeElement($typeEventAuthorization)) {
            // set the owning side to null (unless already changed)
            if ($typeEventAuthorization->getTypeEvent() === $this) {
                $typeEventAuthorization->setTypeEvent(null);
            }
        }

        return $this;
    }
}
