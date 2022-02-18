<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 * @ORM\Table("shops")
 */
class Shop
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $main_image_hash;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $info;

    /**
     * @ORM\OneToMany(targetEntity=ShopImage::class, mappedBy="shop")
     */
    private $shop;
    
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

    public function __construct()
    {
        $this->shop = new ArrayCollection();
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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMain_image_hash(): ?string
    {
    	return $this->main_image_hash;
    }

    public function setMain_image_hash(string $main_image_hash): self
    {
    	$this->main_image_hash= $main_image_hash;

        return $this;
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
    
    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return Collection|ShopImage[]
     */
    public function getShop(): Collection
    {
        return $this->shop;
    }

    public function addShop(ShopImage $shop): self
    {
        if (!$this->shop->contains($shop)) {
            $this->shop[] = $shop;
            $shop->setShop($this);
        }

        return $this;
    }

    public function removeShop(ShopImage $shop): self
    {
        if ($this->shop->removeElement($shop)) {
            // set the owning side to null (unless already changed)
            if ($shop->getShop() === $this) {
                $shop->setShop(null);
            }
        }

        return $this;
    }
}
