<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table("products")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     *@ORM\OneToMany(targetEntity="App\Entity\OrderProduct", mappedBy="productId")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="full_price", type="integer")
     */
    private $fullPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var ProductImage[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProductImage", mappedBy="product")
     */
    private $images;

    /**
     * @var UploadedFile[]
     */
    private $uploadedImages;

    /**
     * @var ProductImage
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductImage")
     * @ORM\JoinColumn(name="main_image_hash", referencedColumnName="image_hash")
     */
    private $mainImage;

        public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getFullPrice(): ?int
    {
        return $this->fullPrice;
    }

    public function setFullPrice(int $fullPrice): void
    {
        $this->fullPrice = $fullPrice;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }

 
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return ProductImage[]|Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setUploadedImages(array $uploadedImages): void
    {
        $this->uploadedImages = $uploadedImages;
    }

    /**
     * @return UploadedFile[]
     */
    public function getUploadedImages(): array
    {
        return $this->uploadedImages ?: [];
    }

    public function addUploadedImage(UploadedFile $image): void
    {
        $this->uploadedImages[] = $image;
    }

    public function getMainImage(): ?ProductImage
    {
        return $this->mainImage;
    }

    public function setMainImage(ProductImage $mainImage): void
    {
        $this->mainImage = $mainImage;
    }

   }