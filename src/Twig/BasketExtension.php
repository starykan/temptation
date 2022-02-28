<?php 

// src/Twig/AppExtension.php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Manager\OrderManager;
use App\Repository\ProductRepository;
use Twig\TwigFunction;

class BasketExtension extends AbstractExtension
{
	private OrderManager $orderManager;
	private Session $session;
	private ProductRepository $productRepository;
	
	public function __construct(OrderManager $orderManager,
															 Session $session,
															 ProductRepository $productRepository)
	{
		
		$this->orderManager = $orderManager;
		$this->productRepository = $productRepository;
		$this->session = $session;
		
	}
	
	public function getFunctions()
	{
		return [new TwigFunction('basketData', [$this, 'basketData'])];
	}
	
	public function basketData()
	{
		
// 		$rawOrder = $this->orderManager->sessionWork($this->session);
		$rawOrder = $this->session -> all($this->session);
		$count = 0;
		$summ = 0;
		foreach ($rawOrder as $id =>$pieces)
		{
			$count += $pieces;
			$product = $this->productRepository->findById($id);
			$price = $product->getPrice();
			$summ+=$price * $pieces;
		}
		return  $count . ' товара<br>'  . $summ . '  р.'	;
	}
	
}