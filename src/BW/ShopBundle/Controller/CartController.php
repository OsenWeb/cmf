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

            $em = $this->getDoctrine()->getManager();

            $order = $cart->getOrder();
            /**
             * Fetch each Product entity from DB, related to OrderedProduct,
             * and reassign it to OrderedProduct (for entity manager correct work!)
             */
            /** @var OrderedProduct $orderedProduct */
            foreach ($order->getOrderedProducts() as $orderedProduct) {
                $productId = $orderedProduct->getProduct()->getId();
                $product = $em->getRepository('BWShopBundle:Product')->find($productId);
                $orderedProduct->setProduct($product);
            }
            $em->persist($order);
            $em->flush();

            $cartService->clear();

            return $this->redirect($this->generateUrl('cart'));
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
