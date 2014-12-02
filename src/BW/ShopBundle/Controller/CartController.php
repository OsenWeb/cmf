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
        $cartService = $this->get('bw_shop.service.cart');
        $cart = $cartService->getCart();
        $form = $cartService->createCheckoutForm($cart->getOrder());

        return $this->render('BWShopBundle:Cart:index.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    public function checkoutAction(Request $request)
    {
        $cartService = $this->get('bw_shop.service.cart');
        $cart = $cartService->getCart();
        $form = $cartService->createCheckoutForm($cart->getOrder());

        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($form->get('recalculate')->isClicked()) {
                $cartService->save();
                return $this->redirect($this->generateUrl('cart'));
            }
            die('valid');
        } else {
//            var_dump($form->getErrors());
        }

        return $this->render('BWShopBundle:Cart:index.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
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
    public function addAction(Request $request)
    {
        $cartService = $this->get('bw_shop.service.cart');
        $cart = $cartService->getCart();

        $orderedProduct = new OrderedProduct();
        $form = $cartService->createAddToCartForm($orderedProduct);
        $form->handleRequest($request);
        if ($form->isValid()) {
            // @TODO Move to event listener
            $orderedProduct->handleProduct();
            $cart->getOrder()->addOrderedProduct($orderedProduct);
            $cartService->save();
        }

        return $this->redirect($this->generateUrl('cart'));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request, $index)
    {
        $cartService = $this->get('bw_shop.service.cart');
        $cart = $cartService->getCart();

        $removedElement = $cart->getOrder()->getOrderedProducts()->remove($index);
        if (null !== $removedElement) {
            $cartService->save();
        }

        return $this->redirect($this->generateUrl('cart'));
    }
}
