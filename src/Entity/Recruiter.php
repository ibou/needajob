<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Recruiter
 * @package App\Entity
 * @ORM\Entity
 */
class Recruiter extends User
{
    private ?string $companyName = null;

    /**
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @param string|null $companyName
     * @return $this
     */
    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }
}
