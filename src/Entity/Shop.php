<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private $main_pic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $info;

    /**
     * @ORM\OneToMany(targetEntity=ShopImage::class, mappedBy="shop")
     */
    private $shop;

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

    public function getMainPic(): ?string
    {
        return $this->main_pic;
    }

    public function setMainPic(string $main_pic): self
    {
        $this->main_pic = $main_pic;

        return $this;
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
