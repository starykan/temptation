<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Manager\ProductManager;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    /**
     * @Route("/catalog", name="client_catalog_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository, ProductManager $productManager): Response
    {
        return $this->redirectToRoute('client_catalog_category', [
            'categoryId' => $categoryRepository->findFirstCategory()->getId(),
        ]);
    }

    /**
     * @Route("/catalog/{categoryId}", name="client_catalog_category", methods={"GET"})
     */
    public function category(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductManager $productManager,
        string $categoryId
    ): Response {
        $category = $categoryRepository->find($categoryId);
        if (!$category) {
            throw $this->createNotFoundException();
        }

        return $this->render('client/catalog/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'products' => $productRepository->findByCategory($category),
            'productManager' => $productManager,
            'activeCategory' => $category,
        ]);
    }


}