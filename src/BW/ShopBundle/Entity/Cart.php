<?php

namespace BW\ShopBundle\Entity;

/**
 * Class Cart
 * @package BW\ShopBundle\Entity
 */
class Cart
{
    /**
     * @var Order
     */
    private $order;

    /**
     * The constructor
     */
    public function __construct()
    {
        $this->order = new Order();
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }
}
