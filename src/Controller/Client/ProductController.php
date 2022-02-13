<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Category;
use App\Entity\ProductImage;
use App\Manager\ProductManager;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ProductController extends AbstractController
{
    /**
     * @Route("/product/product_page/{id}", name="client_product_index", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function index(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        ProductManager $productManager,
    	ProductImage $productImage,
        int $id
    ): Response {
        $product = $productRepository->findById($id);
        $category = $product->getCategory();
        $image = $productRepository->findPics($productImage, $id);
        if (!$category) {
            throw $this->createNotFoundException();
        }
        return $this->render('client/product/product_page.html.twig', [
            'categories' => $categoryRepository->findByGender($category->getGender()),
            'activeCategory' => $category,
            'GENDER_MALE' => Category::GENDER_MALE,
            'GENDER_FEMALE' => Category::GENDER_FEMALE,
            'productManager' => $productManager,
            'product' => $product,
        	'image' =>  $image,
        ]);
    }
}

