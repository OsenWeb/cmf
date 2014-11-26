<?php

namespace BW\ShopBundle\Entity;
use BW\ShopBundle\Form\DataTransformer\EntityToIdTransformerInterface;

/**
 * Class AbstractPurchasableProduct
 * @package BW\ShopBundle\Entity
 */
abstract class AbstractPurchasableProduct implements EntityToIdTransformerInterface
{
    private $quantityInCart = 0;

    private $priceInCart = 0.00;

    abstract public function getId();

    /**
     * @return float
     */
    public function calculateTotalPriceInCart()
    {
        return $this->priceInCart * $this->quantityInCart;
    }

    /**
     * @return int
     */
    public function getQuantityInCart()
    {
        return $this->quantityInCart;
    }

    /**
     * @param int $quantityInCart
     */
    public function setQuantityInCart($quantityInCart)
    {
        $quantityInCart = (int)$quantityInCart;
        $this->quantityInCart = $quantityInCart > 0 ? $quantityInCart : 1;
    }

    /**
     * @return float
     */
    public function getPriceInCart()
    {
        return $this->priceInCart;
    }

    /**
     * @param float $priceInCart
     */
    public function setPriceInCart($priceInCart)
    {
        $this->priceInCart = (float)$priceInCart;
    }
}