<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Shop;
use App\Form\ShopType;
use App\Manager\ShopManager;
use App\Repository\ShopRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shop")
 */
class ShopController extends AbstractController
{
    /**
	*@Route("/", name="admin_shop_index", methods= {"GET"})
	*/
	public function index(ShopRepository $shopRepository,
    											ShopManager $shopManager): Response
    {
        return $this->render('admin/shop/index.html.twig', [
            'shops' => $shopRepository->findAll(),
        ]);
    }
/**
   * @Route("/new", name="admin_shop_new", methods={"GET", "POST"})
   */
    public function new(Request $request, ShopManager $shopManager): Response
    {
        $shop = new Shop();
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        	$shopManager->save($shop);

            return $this->redirectToRoute('admin_shop_index');
        }

        return $this->render('admin/shop/new.html.twig', [
            'shop' => $shop,
            'form' => $form->createView(),
        ]);
    }
    
/**
   *@ Route("/{id}", name= "admin_shop_show", methods= {"GET"})
   */
   public function show(Shop $shop): Response
    {
        return $this->render('admin/shop/show.html.twig', [
            'shop' => $shop,
        ]);
    }
/**
   * @Route("/{id}/edit", name= "admin_shop_edit", methods= {"GET", "POST"})
   */
    public function edit(Request $request, Shop $shop, ShopManager $shopManager): Response
    {
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$shopManager->save($shop);

            return $this->redirectToRoute('admin_shop_index');
        }

        return $this->render('admin/shop/edit.html.twig', [
            'shop' => $shop,
        	'shopManager' => $shopManager,
            'form' => $form->createView(),
        ]);
    }
    
/**
   * @Route("/{id}", name= "admin_shop_delete", methods= {"DELETE"})
   */
    public function delete(Request $request, Shop $shop): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shop->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_shop_index');
    }
}
