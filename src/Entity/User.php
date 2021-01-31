<?php

namespace App\Entity;

use App\Adapter\Doctrine\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"job_seeker" = "JobSeeker", "recruiter" = "Recruiter"})
 */
abstract class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected ?string $firstName = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected ?string $lastName = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $email = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $password = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected ?string $plainPassword = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    protected \DateTimeInterface $registeredAt;


    public function __construct()
    {
        $this->registeredAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getRegisteredAt(): ?\DateTimeInterface
    {
        return $this->registeredAt;
    }
}
