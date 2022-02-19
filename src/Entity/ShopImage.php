<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table("shop_images")
 */
class ShopImage
{

    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(name="image_hash", type="string", length=255)
     */
    private $imageHash;

    /**
     * @var Shop
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop", inversedBy="images")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     */
    private $shop;

    public function getImageHash(): string
    {
        return $this->imageHash;
    }

    public function setImageHash(string $imageHash): void
    {
        $this->imageHash = $imageHash;
    }

    public function getShop(): Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): void
    {
        $this->shop = $shop;
    }
}