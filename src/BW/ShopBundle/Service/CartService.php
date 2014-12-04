<?php

namespace BW\ShopBundle\Service;

use BW\ShopBundle\Entity\Cart;
use BW\ShopBundle\Entity\Order;
use BW\ShopBundle\Entity\OrderedProduct;
use BW\ShopBundle\Entity\Product;
use BW\ShopBundle\Form\CheckoutType;
use BW\ShopBundle\Form\DataTransformer\EntityToIdTransformer;
use BW\ShopBundle\Form\AddToCartType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Router;

/**
 * Class CartService
 * @package BW\ShopBundle\Service
 */
class CartService
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param EntityManager $em
     * @param FormFactory $formFactory
     * @param Router $router
     * @param RequestStack $requestStack
     */
    public function __construct(EntityManager $em, FormFactory $formFactory, Router $router, RequestStack $requestStack)
    {
        /** @TODO Maybe use CartController as a service and remove CartService? */
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->requestStack = $requestStack;

        $this->restore();
    }

    /**
     * @param Product $entity
     * @return OrderedProduct
     */
    public static function createOrderedProductFor(Product $entity)
    {
        return new OrderedProduct($entity);
    }

    /**
     * @param Order $entity
     * @return Form|\Symfony\Component\Form\FormInterface
     */
    public function createCheckoutForm(Order $entity = null)
    {
        $form = $this->formFactory->create(new CheckoutType(), $entity, [
//            'csrf_protection' => false,
            'action' => $this->router->generate('cart_checkout'),
        ]);

        return $form;
    }

    /**
     * @param OrderedProduct $entity
     * @return Form
     */
    public function createAddToCartForm(OrderedProduct $entity = null)
    {
        $form = $this->formFactory->create(new AddToCartType(), $entity, [
//            'csrf_protection' => false,
            'action' => $this->router->generate('cart_add'),
            'em' => $this->em,
        ]);

        return $form;
    }

    /**
     * @param int $key
     * @return Form
     */
    public function createRemoveFromCartForm($key = null)
    {
        $key = (int)$key;
        // this assumes that the entity manager was passed in as an option
        $transformer = new EntityToIdTransformer($this->em->getRepository('BWShopBundle:Product'));

        /** @var FormBuilder $builder */
        $builder = $this->formFactory->createBuilder('form', null, [
//            'csrf_protection' => false,
        ])->setAction($this->router->generate('cart_remove'));

        $builder
            // Key of value (AbstractPurchasableProduct entity) in ArrayCollection
            ->add('item_key', 'hidden', [
                'data_class' => null,
                'data' => $key,
            ])
            ->add('add', 'submit', [
                'label' => 'Удалить из корзины',
                'attr' => [
                    'class' => 'remove-from-cart-button',
                ],
            ]);

        return $builder->getForm();
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @return $this
     */
    public function initEmpty()
    {
        $this->cart = new Cart;

        return $this;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();

        $this->initEmpty();
        $session->remove('cart');

        return $this;
    }

    /**
     * @return $this
     */
    public function save()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();

        $session->set('cart', serialize($this->cart));

        return $this;
    }

    /**
     * @return $this
     */
    public function restore()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();

        $this->cart = null;
        // Try to restore cart from session
        if ($session->has('cart')) {
            $this->cart = unserialize($session->get('cart'));

            // Check whether cart in session is correct
            if ($this->cart instanceof Cart) {
                $order = $this->cart->getOrder();
                if ($delivery = $order->getDelivery()) {
                    $delivery = $this->em->getRepository('BWShopBundle:Delivery')->find($delivery->getId());
                    $order->setDelivery($delivery);
                }

                if ($payment = $order->getPayment()) {
                    $payment = $this->em->getRepository('BWShopBundle:Payment')->find($payment->getId());
                    $order->setPayment($payment);
                }

                /**
                 * Fetch each Product entity from DB, related to OrderedProduct,
                 * and reassign it to OrderedProduct (for entity manager correct work!)
                 */
                /** @var OrderedProduct $orderedProduct */
                foreach ($order->getOrderedProducts() as $orderedProduct) {
                    if ($product = $orderedProduct->getProduct()) {
                        $product = $this->em->getRepository('BWShopBundle:Product')->find($product->getId());
                        $orderedProduct->setProduct($product);
                    }
                }
            } else {
                $this->cart = null;
            }
        }
        // Init empty cart if restore from session failed
        if (null === $this->cart) {
            $this->initEmpty();
        }

        return $this;
    }
}
