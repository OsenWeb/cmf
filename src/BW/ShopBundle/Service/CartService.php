<?php

namespace BW\ShopBundle\Service;

use BW\ShopBundle\Entity\Cart;
use BW\ShopBundle\Entity\CartItemInterface;
use BW\ShopBundle\Form\DataTransformer\EntityToIdTransformer;
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
    private $entity;

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
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->requestStack = $requestStack;

        $this->restore();
    }


    /**
     * @param CartItemInterface $item
     * @return Form
     */
    public function createForm(CartItemInterface $item = null)
    {
        /** @var FormBuilder $builder */
        $builder = $this->formFactory->createBuilder('form', null, [
            'csrf_protection' => false,
        ])
            ->setAction($this->router->generate('cart_add_item'))
            ->add('add', 'submit', [
                'label' => 'Добавить в корзину',
                'attr' => [
                    'class' => 'add-to-cart-button',
                ],
            ]);

        // this assumes that the entity manager was passed in as an option
        $transformer = new EntityToIdTransformer($this->em->getRepository('BWShopBundle:Product'));

        // add a normal text field, but add your transformer to it
        $builder->add(
            $builder->create('item', 'hidden', [
                'data_class' => null,
                'data' => $item,
            ])->addModelTransformer($transformer)
        );

        return $builder->getForm();
    }

    /**
     * @return Cart
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return $this
     */
    public function initEmpty()
    {
        $this->entity = new Cart;

        return $this;
    }

    /**
     * @return $this
     */
    public function save()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();

        $session->set('cart', serialize($this->entity));

        return $this;
    }

    /**
     * @return $this
     */
    public function restore()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();

        $this->entity = null;
        if ($session->has('cart')) {
            $this->entity = unserialize($session->get('cart'));

            if (! $this->entity instanceof Cart) {
                $this->entity = null;
            }
        }
        if (null === $this->entity) {
            $this->initEmpty();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();

        $session->remove('cart');
        $this->initEmpty();

        return $this;
    }
}
