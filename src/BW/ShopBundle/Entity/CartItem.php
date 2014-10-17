<?php

namespace BW\ShopBundle\Entity;

/**
 * Class CartItem
 * @package BW\ShopBundle\Entity
 */
class CartItem
{
    /**
     * @var CartItemInterface
     */
    private $entity;

    private $quantity = 1;

    private $price = 0.00;


    /**
     * @param CartItemInterface $entity
     */
    public function __construct(CartItemInterface $entity = null)
    {
        if (null !== $entity) {
            $this->setEntity($entity);
        }
    }


    public function handleCurrentEntity()
    {
        $this->setPrice($this->entity->getPrice());
    }

    /**
     * @return CartItemInterface
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param CartItemInterface $entity
     * @return $this
     */
    public function setEntity(CartItemInterface $entity)
    {
        $this->entity = $entity;
        $this->handleCurrentEntity();

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $quantity = (int)$quantity;

        $this->quantity = $quantity > 0 ? $quantity : 1;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function calculateTotalPrice()
    {
        return $this->price * $this->quantity;
    }
}
