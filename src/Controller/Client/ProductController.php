<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Category;
use App\Manager\ProductManager;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    /**
     * @Route("/product/product_page/{id}", name="client_product_index", methods={"GET"}, defaults={"id"=40})
     */
    public function index(ProductRepository $productRepository, int $id): Response
    {
        return $this->render('client/product/product_page.html.twig', [

           'products' => $productRepository->findById((int)$id)->getId(),

        ]);
    }

}

