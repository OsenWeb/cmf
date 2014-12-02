<?php

namespace BW\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Order
 * @package BW\ShopBundle\Entity
 */
class Order
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var ArrayCollection
     */
    private $orderedProducts;

    /**
     * The constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->orderedProducts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function calculateTotalQuantity()
    {
        die('calculateTotalQuantity');
    }

    /**
     * @return float
     */
    public function calculateTotalPrice()
    {
        die('calculateTotalPrice');
    }

    /* SETTERS / GETTERS */

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Order
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Order
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOrderedProducts()
    {
        return $this->orderedProducts;
    }

    /**
     * @param ArrayCollection $orderedProducts
     * @return $this
     */
    public function setOrderedProducts(ArrayCollection $orderedProducts)
    {
        foreach ($orderedProducts as $orderedProduct) {
            if (! $orderedProduct instanceof OrderedProduct) {
                throw new \UnexpectedValueException(
                    'Each item in orderedProducts array collection should be instance of BW\ShopBundle\Entity\OrderedProduct'
                );
            }
        }
        $this->orderedProducts = $orderedProduct;

        return $this;
    }

    /**
     * Add item to cart
     *
     * @param OrderedProduct $orderedProduct
     * @return $this
     */
    public function addOrderedProduct(OrderedProduct $orderedProduct)
    {
        if (! $this->getOrderedProducts()->exists(function ($key, $value) use ($orderedProduct) {
            /** @var OrderedProduct $value */
            $isEqual = $value->getProduct()->getId() === $orderedProduct->getProduct()->getId();
            if (true === $isEqual) {
                $value->setQuantity($value->getQuantity() + $orderedProduct->getQuantity()); // merge quantities
            }

            return $isEqual;
        })) {
            $this->orderedProducts->add($orderedProduct);
        }

        return $this;
    }
}
