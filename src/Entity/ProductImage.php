<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table("product_images")
 */
class ProductImage
{

    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(name="image_hash", type="string", length=255)
     */
    private $imageHash;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    public function getImageHash(): string
    {
        return $this->imageHash;
    }

    public function setImageHash(string $imageHash): void
    {
        $this->imageHash = $imageHash;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

}