<?php


namespace App\Manager;


use App\Entity\Product;
use App\Entity\ProductImage;
use Doctrine\Persistence\ObjectManager;

class ProductManager
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function save(Product $product): void
    {
        $this->objectManager->persist($product);
        $this->objectManager->flush();
        foreach ($product->getImages() as $image) {
            $imageEntity = new ProductImage();
            $imageEntity->setProduct($product);
            $imageEntity->setImageHash(uniqid());
            $this->objectManager->persist($imageEntity);
            $targetDir = __DIR__ . '/../../../public/uploads/products/' . $product->getId() . '/full';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $image->move($targetDir, $imageEntity->getImageHash() . '.jpg');
        }
        $this->objectManager->flush();
    }

}