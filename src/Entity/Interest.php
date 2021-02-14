<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package App\Entity
 */
class Interest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeInterface $sentAt;

    /**
     * @ORM\ManyToOne(targetEntity="Offer")
     */
    private Offer $offer;

    /**
     * @ORM\ManyToOne(targetEntity="JobSeeker")
     */
    private JobSeeker $jobSeeker;

    public function __construct()
    {
        $this->sentAt = new \DateTimeImmutable();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable|\DateTimeInterface
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * @return Offer
     */
    public function getOffer(): Offer
    {
        return $this->offer;
    }

    /**
     * @param Offer $offer
     */
    public function setOffer(Offer $offer): self
    {
        $this->offer = $offer;
        return $this;
    }

    /**
     * @return JobSeeker
     */
    public function getJobSeeker(): JobSeeker
    {
        return $this->jobSeeker;
    }

    /**
     * @param JobSeeker $jobSeeker
     */
    public function setJobSeeker(JobSeeker $jobSeeker): self
    {
        $this->jobSeeker = $jobSeeker;
        return $this;
    }
}
