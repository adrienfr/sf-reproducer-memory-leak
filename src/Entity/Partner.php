<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Partner.
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass=PartnerRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Partner
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_partner", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPartner;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage="partner.name.min_size",
     *     maxMessage="partner.name.max_size"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Flat::class, mappedBy="partner")
     */
    private $flats;

    public function __construct()
    {
        $this->flats = new ArrayCollection();
    }

    public function getIdPartner(): ?int
    {
        return $this->idPartner;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function addFlat(Flat $flat): self
    {
        if (!$this->flats->contains($flat)) {
            $this->flats->add($flat);
        }

        return $this;
    }

    public function removeFlat(Flat $flat): self
    {
        if ($this->flats->contains($flat)) {
            $this->flats->removeElement($flat);
        }

        return $this;
    }

    public function getFlats(): Collection
    {
        return $this->flats;
    }
}
