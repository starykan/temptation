<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$session->start();

// устанавливать и получать атрибуты сессии
$session->set('name', 'Drak');
$session->get('name');

// устанавливать флеш-сообщения
$session->getFlashBag()->add('notice', 'Profile updated');

// извлекать сообщения
foreach ($session->getFlashBag()->get('notice', []) as $message) {
	echo '<div class="flash-notice">'.$message.'</div>';}
	
	
	$productList = [123 => 2];
	$productIds = array_keys($productList);
	$productEntitiesRaw = $repository->getByIds($productIds);
	// $productEntities = [$productId => $productEntity]
	foreach ($productList as $productId => $count) {
		$product = $productEntities[$productId];
		
	}