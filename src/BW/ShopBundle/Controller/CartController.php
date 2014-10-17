<?php

namespace BW\ShopBundle\Controller;

use BW\ShopBundle\Entity\CartItem;
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
        $cart = $this->get('bw_shop.service.cart')->getEntity();

        return $this->render('BWShopBundle:Cart:index.html.twig', [
            'cart' => $cart,
        ]);
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
        $cart = $cartService->getEntity();

        $form = $cartService->createForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();

            $item = new CartItem($data['item']);
            $cart->addItem($item);
            $cartService->save();
        }

        return $this->redirect($this->generateUrl('cart'));
    }
}
