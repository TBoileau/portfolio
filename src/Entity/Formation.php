<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Formation
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private ?string $name = null;

    /**
     * @var string|null
     * @ORM\Column
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private ?string $school = null;

    /**
     * @var int|null
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private ?int $gradeLevel = null;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private ?string $description = null;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="date_immutable")
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private ?DateTimeInterface $startedAt = null;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private ?DateTimeInterface $endedAt = null;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getSchool(): ?string
    {
        return $this->school;
    }

    /**
     * @param string|null $school
     */
    public function setSchool(?string $school): void
    {
        $this->school = $school;
    }

    /**
     * @return int|null
     */
    public function getGradeLevel(): ?int
    {
        return $this->gradeLevel;
    }

    /**
     * @param int|null $gradeLevel
     */
    public function setGradeLevel(?int $gradeLevel): void
    {
        $this->gradeLevel = $gradeLevel;
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
}
