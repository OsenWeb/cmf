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
     * @param OrderedProduct $item
     * @return $this
     */
    public function addItem(OrderedProduct $item)
    {
        if (! $this->getItems()->exists(function ($key, $value) use ($item) {
            /** @var OrderedProduct $value */
            $isEqual = $value->getProduct()->getId() === $item->getProduct()->getId();
            if (true === $isEqual) {
                $value->setQuantity($value->getQuantity() + $item->getQuantity()); // merge quantities
            }

            return $isEqual;
        })) {
            $this->items->add($item);
        }

        return $this;
    }
}
