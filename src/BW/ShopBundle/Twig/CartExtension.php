<?php

namespace BW\ShopBundle\Twig;

use BW\ShopBundle\Entity\AbstractPurchasableProduct;
use BW\ShopBundle\Entity\Cart;
use BW\ShopBundle\Entity\CartItem;
use BW\ShopBundle\Entity\CartItemInterface;
use BW\ShopBundle\Entity\Order;
use BW\ShopBundle\Entity\OrderedProduct;
use BW\ShopBundle\Entity\Product;
use BW\ShopBundle\Service\CartService;
use Symfony\Component\Form\Form;
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
            new \Twig_SimpleFunction('bw_cart_widget', array($this, 'cartWidgetFunction'), [
                'is_safe' => ['html'],
            ]),
        );
    }

    /**
     * Render cart template
     *
     * @return string
     */
    public function cartWidgetFunction()
    {
        return $this->twig->render('BWShopBundle:Cart:cart.html.twig', [
            'cart' => $this->cartService->getCart(),
        ]);
    }
}
