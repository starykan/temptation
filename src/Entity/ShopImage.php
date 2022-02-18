<?php

namespace App\Entity;

use App\Repository\ShopImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopImageRepository::class)
 */
class ShopImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageHash;

    /**
     * @var Shop
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="shop")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shop;

    public function getImageHash(): ?string
    {
        return $this->imageHash;
    }

    public function setImageHash(string $imageHash): self
    {
        $this->imageHash = $imageHash;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;
    }
}