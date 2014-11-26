<?php

namespace BW\ShopBundle\Twig;

use BW\ShopBundle\Entity\CartItem;
use BW\ShopBundle\Entity\CartItemInterface;
use BW\ShopBundle\Service\CartService;
use Twig_Environment;

class CartExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var CartService
     */
    private $cart;

    /**
     * @param CartService $cart
     */
    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @param Twig_Environment $environment
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->twig = $environment;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cart_extension';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('bw_cart_render', array($this, 'cartRenderFunction'), [
                'is_safe' => ['html'],
            ]),
            new \Twig_SimpleFunction('bw_add_to_cart_form_render', array($this, 'addToCartFormRenderFunction'), [
                'is_safe' => ['html'],
            ]),
            new \Twig_SimpleFunction('bw_remove_from_cart_form_render', array($this, 'removeFromCartFormRenderFunction'), [
                'is_safe' => ['html'],
            ]),
        );
    }

    public function cartRenderFunction()
    {
        return $this->twig->render('BWShopBundle:Cart:cart.html.twig', [
            'cart' => $this->cart->getEntity(),
        ]);
    }

    /**
     * @param CartItemInterface $entity
     * @return string
     */
    public function addToCartFormRenderFunction(CartItemInterface $entity)
    {
        $form = $this->cart->createAddToCartForm($entity);

        return $this->twig->render('BWShopBundle:Cart:add-to-cart-form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param CartItem $cartItem
     * @return string
     */
    public function removeFromCartFormRenderFunction(CartItem $cartItem)
    {
        $form = $this->cart->createRemoveFromCartForm($cartItem);

        return $this->twig->render('BWShopBundle:Cart:remove-from-cart-form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}