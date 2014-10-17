<?php

namespace BW\ShopBundle\Form\DataTransformer;

use BW\ShopBundle\Entity\Entity;

/**
 * Interface EntityToIdTransformerInterface
 * @package BW\ShopBundle\Form\DataTransformer
 */
interface EntityToIdTransformerInterface
{
    public function getId();
}
