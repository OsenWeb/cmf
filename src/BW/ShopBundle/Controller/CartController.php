<?php

namespace BW\ShopBundle\Controller;

use BW\ShopBundle\Entity\OrderedProduct;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CartController
 * @package BW\ShopBundle\Controller
 */
class CartController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $cart = $this->get('bw_shop.service.cart')->getCart();

        return $this->render('BWShopBundle:Cart:index.html.twig', [
            'cart' => $cart,
        ]);
    }

    public function checkoutAction()
    {

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function clearAction()
    {
        $this->get('bw_shop.service.cart')->clear();

        return $this->redirect($this->generateUrl('cart'));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addItemAction(Request $request)
    {
        $cartService = $this->get('bw_shop.service.cart');
        $cart = $cartService->getCart();

        $orderedProduct = new OrderedProduct();
        $form = $cartService->createAddToCartForm($orderedProduct);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $orderedProduct->handleProduct();
            $cart->addItem($orderedProduct);
            $cartService->save();
        }

        return $this->redirect($this->generateUrl('cart'));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeItemAction(Request $request)
    {
        $cartService = $this->get('bw_shop.service.cart');
        $cart = $cartService->getCart();

        $form = $cartService->createRemoveFromCartForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $cart->getItems()->remove($data['item_key']);
            $cartService->save();
        }

        return $this->redirect($this->generateUrl('cart'));
    }
}
