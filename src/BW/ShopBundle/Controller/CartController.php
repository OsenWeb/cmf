<?php

namespace BW\ShopBundle\Controller;

use BW\ShopBundle\Entity\AbstractPurchasableProduct;
use BW\ShopBundle\Entity\CartItem;
use BW\ShopBundle\Entity\Product;
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

        $form = $cartService->createAddToCartForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            /** @var Product $item */
            $item = $data['item'];
            // Set entity price for display in cart
            $price = 0.00 < $item->getDiscountPrice() ? $item->getDiscountPrice() : $item->getPrice();
            $item->setPriceInCart($price);
            // Set entity quantity in cart
            $item->setQuantityInCart(1);
            $cart->addItem($item);
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
