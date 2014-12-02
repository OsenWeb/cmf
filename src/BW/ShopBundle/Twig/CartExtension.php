<?php

namespace BW\ShopBundle\Twig;

use BW\ShopBundle\Entity\AbstractPurchasableProduct;
use BW\ShopBundle\Entity\CartItem;
use BW\ShopBundle\Entity\CartItemInterface;
use BW\ShopBundle\Entity\OrderedProduct;
use BW\ShopBundle\Entity\Product;
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
    private $cartService;

    /**
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
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

    /**
     * Render cart template
     *
     * @return string
     */
    public function cartRenderFunction()
    {
        return $this->twig->render('BWShopBundle:Cart:cart.html.twig', [
            'cart' => $this->cartService->getCart(),
        ]);
    }

    /**
     * Render add ordered products to cart form
     *
     * @param Product $entity
     * @return string
     */
    public function addToCartFormRenderFunction(Product $entity)
    {
        $orderedProduct = new OrderedProduct($entity);
        $form = $this->cartService->createAddToCartForm($orderedProduct);

        return $this->twig->render('BWShopBundle:Cart:add-to-cart-form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Render remove ordered products from cart form
     *
     * @param OrderedProduct $entity
     * @return string
     */
    public function removeFromCartFormRenderFunction(OrderedProduct $entity)
    {
        $key = $this->cartService->getCart()->getOrder()->getOrderedProducts()->indexOf($entity);
        $form = $this->cartService->createRemoveFromCartForm($key);

        return $this->twig->render('BWShopBundle:Cart:remove-from-cart-form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
