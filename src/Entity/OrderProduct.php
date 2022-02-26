<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OrderProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table("order_products")
 */
class OrderProduct
{

    /**
     * @var Order
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="id")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $productId;

    /**
     * @var Order
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="id")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $orderId;

    /**
     * @var integer
     * @ORM\Count()
     * @ORM\Column(name="count",type="integer", nullable=true)
     */
    private $count;

	public function getProductId(): ?Product
    {
        return $this->productId;
    }

    public function setProductId(?Product $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->orderId;
    }

    public function setOrderId(?Order $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
