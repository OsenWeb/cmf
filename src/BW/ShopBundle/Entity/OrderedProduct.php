<?php

namespace BW\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OrderedProduct
 * @package BW\ShopBundle\Entity
 */
class OrderedProduct
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $quantity = 1;

    /**
     * @var string
     */
    private $price = 0.00;

    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product = null)
    {
        $this->product = $product;
    }

    /**
     * @return OrderedProduct
     */
    public function handleProduct()
    {
        /** @TODO Move logic to event listener */
        if ($this->getProduct()) {
            // Set entity price for display in cart
            $price = 0.00 < $this->getProduct()->getDiscountPrice()
                ? $this->getProduct()->getDiscountPrice()
                : $this->getProduct()->getPrice();
            $this->setPrice($price);
        }

        return $this;
    }

    /**
     * @return float
     */
    public function calculateTotalPrice()
    {
        return $this->price * $this->quantity;
    }

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
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderedProduct
     */
    public function setQuantity($quantity)
    {
        $quantity = (int)$quantity;
        $this->quantity = $quantity > 0 ? $quantity : 1;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return OrderedProduct
     */
    public function setPrice($price)
    {
        $this->price = (float)$price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return OrderedProduct
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }
}
