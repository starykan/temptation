<?php

declare(strict_types=1);

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Shop;
use Doctrine\ORM\Query;
use App\Repository\ShopRepository;
use App\Manager\ShopManager;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends AbstractController
{
    /**
     * @Route("/shops", name="client_shops_index",  methods={"GET"})
     */
    public function index(ShopRepository $shopRepository,
    											ShopManager $shopManager): Response
    {
    	return $this->render('client/shops/index.html.twig', [ 
    			'shops' => $shopRepository->findAll(),
    			'shopManager' => $shopManager
    	]);
    }
}
