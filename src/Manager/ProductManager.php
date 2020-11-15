<?php


namespace App\Manager;


use App\Entity\Product;
use App\Entity\ProductImage;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\RouterInterface;

class ProductManager
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

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
        foreach ($product->getUploadedImages() as $image) {
            $imageEntity = new ProductImage();
            $imageEntity->setProduct($product);
            $imageEntity->setImageHash(uniqid());
            $this->entityManager->persist($imageEntity);
            $targetDir = $this->uploadsDir . '/products/' . $product->getId() . '/full';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $image->move($targetDir, $imageEntity->getImageHash() . '.jpg');
        }
        $this->entityManager->flush();
    }

    public function getImageFullUrl(ProductImage $image): string
    {
        return $this->router->generate(
            'uploaded_product_image_full',
            ['product_id' => $image->getProduct()->getId(), 'image_hash' => $image->getImageHash()]
        );
    }
}