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
     * Add items
     *
     * @param \BW\ShopBundle\Entity\CartItem $item
     * @return Cart
     */
    public function addItem(CartItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \BW\ShopBundle\Entity\CartItem $item
     * @return Cart
     */
    public function removeItem(CartItem $item)
    {
        $this->items->removeElement($item);

        return $this;
    }

    /**
     * @param \BW\ShopBundle\Entity\CartItem $item
     * @return Cart
     */
    public function hasItem(CartItem $item)
    {
        return $this->items->contains($item);
    }

    /**
     * @param ArrayCollection $items
     * @return Cart
     */
    public function setItems(ArrayCollection $items)
    {
        // @TODO Maybe check each element for CartItem type
        $this->items = $items;

        return $this;
    }
}
