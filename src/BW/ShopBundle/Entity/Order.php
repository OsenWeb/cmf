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
     * @var ArrayCollection
     */
    private $orderedProducts;

    /**
     * @var Status
     */
    private $status;

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
     * @return ArrayCollection
     */
    public function getOrderedProducts()
    {
        return $this->orderedProducts;
    }

    /**
     * @param ArrayCollection $orderedProducts
     * @return Order
     */
    public function setOrderedProducts(ArrayCollection $orderedProducts)
    {
        $this->orderedProducts = $orderedProducts;

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
}
