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
use App\Manager\ProductManager;
use App\Entity\Order;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="client_order_index")
     */
	public function index(OrderManager $orderManager,
    											Session $session,
									    		ProductRepository $productRepository,
			                                    ProductManager $productManager)
    {
    	if(!$session){
    		return $this->render('client/order/index.html.twig');
//     	}else{
//     	$session = new Session();
//     	$session->start();
//     	$rawOrder = $session -> get($id);
//     	$count = 0;
//     	$summ = 0;
//     	foreach ($rawOrder as $id =>$pieces)
//     	{
//     		$product = $productRepository->findById($id);
//     		$price = $product->getPrice();
//     		$products []= $product;
//     		$count += $pieces;
//     		$summ+=$price * $pieces;
//     	}
//     	        return $this->render('client/order/index.html.twig',[
//         		'product' => $product,
//     	        'pieces' => $pieces,
//     	        'price' => $price = $product->getPrice(),
//     	        'summ' => $summ,
//     	        'count' => $count,
//     	        'productManager' => $productManager,
// 				'products' => $products,
//         ]);
    	}
    }
}
//     /**
//      * @Route("/basket", name="product_form")
//      */
//     public function basket(OrderManager $orderManager,
//     											   Session $session,									   
//     											   ProductRepository $productRepository)
//     {	
//     	$rawOrder = $orderManager->sessionWork($session);
//     	$rawOrder = $session -> all($session);
//     	$count = 0;
//     	$summ = 0;
//     	foreach ($rawOrder as $id =>$pieces)
//     	{
//     		$count += $pieces;
//     		$product = $productRepository->findById($id);
//     		$price = $product->getPrice();
//     		$summ+=$price * $pieces;
//     	}

//     	return new JsonResponse([	'response' => true,
//     			'redirectUrl'      => false,
//     			'responseContent'  =>  $count . ' товара<br>'  . $summ . '  р.'
//     	]);
//     }
    
//     public function new(Request $request): Response
//     {
//     	$category = new Order();
//     	$form = $this->createForm(Order::class, $order);
//     	$form->handleRequest($request);
    	
//     	if ($form->isSubmitted() && $form->isValid()) {
//     		$entityManager = $this->getDoctrine()->getManager();
//     		$entityManager->persist($order);
//     		$entityManager->flush();
    		
//     		return $this->redirectToRoute('admin_category_index');
//     	}
    	
//     	return $this->render('admin/category/new.html.twig', [
//     			'category' => $category,
//     			'form' => $form->createView(),
//     	]);
//     }
    
//    return $this->header('Content-type: application/json');
//     $array = array( 'response'         => true,
//     							  'redirectUrl'      => false,
//     							  'responseContent'  => ' ');
//     echo json_encode($array);
    
// }