<?php

namespace App\Entity;

use App\Repository\FlatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Flat.
 *
 * @ORM\Table(name="flat", indexes={@ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity(repositoryClass=FlatRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Flat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", options={"default": 0})
     */
    private $status = false;

    /**
     * @ORM\ManyToOne(targetEntity=Partner::class, inversedBy="flats")
     * @ORM\JoinColumn(name="id_partner", referencedColumnName="id_partner", nullable=true)
     */
    private $partner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }
}
