<?php

namespace BW\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Cart
 * @package BW\ShopBundle\Entity
 */
class Cart
{
    /**
     * @var ArrayCollection
     */
    private $items;

    /**
     * The constructor
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ArrayCollection $items
     * @return Cart
     */
    public function setItems(ArrayCollection $items)
    {
        // @TODO Maybe check each element for AbstractPurchasableProduct type
        $this->items = $items;

        return $this;
    }

    /**
     * Add item to cart
     *
     * @param AbstractPurchasableProduct $item
     * @return $this
     */
    public function addItem(AbstractPurchasableProduct $item)
    {
        if (! $this->getItems()->exists(function ($key, $value) use ($item) {
            /** @var AbstractPurchasableProduct $value */
            $result = $value->getId() === $item->getId();
            if (true === $result) {
                $value->setQuantityInCart($value->getQuantityInCart() + $item->getQuantityInCart()); // merge quantities
            }

            return $result;
        })) {
            $this->items->add($item);
        }

        return $this;
    }
}
