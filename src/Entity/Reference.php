<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Reference
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ReferenceRepository")
 */
class Reference
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @Groups({"get"})
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get"})
     */
    private ?string $title = null;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get"})
     */
    private ?string $company = null;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get"})
     */
    private ?string $description = null;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="date_immutable")
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Groups({"get"})
     */
    private ?DateTimeInterface $startedAt = null;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="date_immutable", nullable=true)
     * @Groups({"get"})
     */
    private ?DateTimeInterface $endedAt = null;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Media", mappedBy="reference", cascade={"persist"}, orphanRemoval=true)
     * @Assert\Count(min=1, minMessage="Vous devez ajouter au moins une image.")
     * @Groups({"get"})
     */
    private Collection $medias;

    /**
     * Reference constructor.
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string|null $company
     */
    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStartedAt(): ?DateTimeInterface
    {
        return $this->startedAt;
    }

    /**
     * @param DateTimeInterface|null $startedAt
     */
    public function setStartedAt(?DateTimeInterface $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndedAt(): ?DateTimeInterface
    {
        return $this->endedAt;
    }

    /**
     * @param DateTimeInterface|null $endedAt
     */
    public function setEndedAt(?DateTimeInterface $endedAt): void
    {
        $this->endedAt = $endedAt;
    }

    /**
     * @return Collection
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    /**
     * @param Media $media
     */
    public function addMedia(Media $media): void
    {
        if (!$this->medias->contains($media)) {
            $media->setReference($this);
            $this->medias->add($media);
        }
    }

    /**
     * @param Media $media
     */
    public function removeMedia(Media $media): void
    {
        if ($this->medias->contains($media)) {
            $media->setReference(null);
            $this->medias->removeElement($media);

        }
    }
}
