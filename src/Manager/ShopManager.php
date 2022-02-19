<?php

namespace App\Manager;

use App\Entity\Shop;
use App\Entity\ShopImage;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\RouterInterface;

class ShopManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var string
     */
    private $uploadsDir;

    public function __construct(EntityManagerInterface $entityManager, RouterInterface $router, string $uploadsDir)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->uploadsDir = $uploadsDir;
    }

    public function save(Shop $shop): void
    {
        $this->entityManager->persist($shop);
        $this->entityManager->flush();
        foreach ($shop->getUploadedImages() as $image) {
            $imageEntity = new ShopImage();
            $imageEntity->setShop($shop);
            $imageEntity->setImageHash(uniqid());
            $this->entityManager->persist($imageEntity);
            if (!$shop->getMainImage()) {
                $shop->setMainImage($imageEntity);
            }
            $targetDir = $this->uploadsDir . '/shops/' . $shop->getId() . '/full';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $image->move($targetDir, $imageEntity->getImageHash() . '.jpg');
        }
        $this->entityManager->flush();
    }

    public function getImageFullUrl(ShopImage $image): string
    {
        return $this->router->generate(
            'uploaded_shop_image_full',
            ['shop_id' => $image->getShop()->getId(), 'image_hash' => $image->getImageHash()]
        );
    }
}