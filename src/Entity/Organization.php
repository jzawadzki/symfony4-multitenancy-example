<?php declare(strict_types=1);

namespace App\Entity;

use App\Multitenancy\Tenant;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRepository")
 */
class Organization implements Tenant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subdomain;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="tenant", orphanRemoval=true)
     */
    private $notes;

    public function __construct(string $subdomain, string $name)
    {
        $this->notes = new ArrayCollection();
        $this->name = $name;
        $this->subdomain = $subdomain;
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

    public function getSubdomain(): ?string
    {
        return $this->subdomain;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }
}
