<?php

declare(strict_types=1);

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Manager\OrderManager;
use App\Entity\Product;
use App\Repository\ProductRepository;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="client_order_index")
     */
    public function index(Session $session)
    {
    	
        return $this->render('client/order/index.html.twig',[
        	        		
        ]);
    }
    
    /**
     * @Route("/basket", name="product_form")
     */
    public function basket(OrderManager $orderManager,
    											   Session $session,
    											   Product $product,
    											   ProductRepository $productRepository)
    {
    	
    	$q = $orderManager->sessionWork($session);
    	$q = $session -> all($session);
    	$count = 0;
    	$summ = 0;
    	foreach ($q as $k =>$v)
    	{
    		$count += $v;
    		$product = $productRepository->findById($k);
    		$price = $product->getPrice();
    		$k = $price * $v;
    		$summ+=$k;
    	}
    	
    	$arr = [	'response' => true,
		    			'redirectUrl'      => false,
		    			'responseContent'  =>  $count . ' товара<br>'  . $summ . '  р.'
    	];
    	return new JsonResponse($arr);
    }
}
