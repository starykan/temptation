<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Category;
use App\Manager\ProductManager;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    /**
     * @Route("/catalog/genders/{gender}", name="client_catalog_index", methods={"GET"}, requirements={"gender"="(1|2)"}, defaults={"gender"=2})
     */
    public function index(CategoryRepository $categoryRepository, string $gender): Response
    {
        return $this->redirectToRoute('client_catalog_category', [
            'categoryId' => $categoryRepository->findFirstCategory((int)$gender)->getId(),
        ]);
    }



    /**
     * @Route("/catalog/categories/{categoryId}", name="client_catalog_category", methods={"GET"})
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
            'categories' => $categoryRepository->findByGender($category->getGender()),
            'products' => $productRepository->findByCategory($category),
            'productManager' => $productManager,
            'activeCategory' => $category,
            'GENDER_MALE' => Category::GENDER_MALE,
            'GENDER_FEMALE' => Category::GENDER_FEMALE,
            'product' => $productRepository,
        ]);
    }

}