<?php 

namespace App\Manager;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class OrderManager {
	function sessionWork(Session $session) {
		
		if (!$session) {
			$session = new Session();
			$session->start();
			$session->set($_POST['product_id'], $_POST['count']);
		}else {
			$session->set($_POST['product_id'], $_POST['count']);
		}
		}
	
	function countSumm(Session $session) {
		;
	}
}