<?php

namespace BW\ShopBundle\Twig;

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
            new \Twig_SimpleFunction('bw_add_to_cart_button_render_for', array($this, 'addToCartButtonRenderFunction'), [
                'is_safe' => ['html'],
            ]),
            new \Twig_SimpleFunction('bw_cart_render', array($this, 'cartRenderFunction'), [
                'is_safe' => ['html'],
            ]),
        );
    }

    /**
     * @param CartItemInterface $entity
     * @return string
     */
    public function addToCartButtonRenderFunction(CartItemInterface $entity)
    {
        $form = $this->cart->createForm($entity);

        return $this->twig->render('BWShopBundle:Cart:add-to-cart-button.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function cartRenderFunction()
    {
        return $this->twig->render('BWShopBundle:Cart:cart.html.twig', [
            'cart' => $this->cart->getEntity(),
        ]);
    }
}