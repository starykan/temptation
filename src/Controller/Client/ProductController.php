<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Manager\ProductManager;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="client_product_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository, ProductManager $productManager): Response
    {
        return $this->render('client/product/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'products' => $productRepository->findAll(),
            'productManager' => $productManager,
        ]);
    }

}