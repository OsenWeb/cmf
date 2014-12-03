<?php

namespace BW\ShopBundle\EventListener;

use BW\ShopBundle\Entity\Order;
use BW\ShopBundle\Entity\Status;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class OrderListener
 * @package BW\ShopBundle\EventListener
 */
class OrderListener
{
    /**
     * @param Order $order
     * @param LifecycleEventArgs $args
     */
    public function prePersist(Order $order, LifecycleEventArgs $args)
    {
        $status = $order->getStatus();

        if (! $status) {
            $em = $args->getEntityManager();
            // Find status in repository
            $status = $em->getRepository('BWShopBundle:Status')->findOneByAlias('new');
            if (! $status) {
                // Create new status if not found
                $status = (new Status())->setAlias('new')->setName('Новый заказ');
                $em->persist($status);
            }
            // Assign new status to order
            $order->setStatus($status);
        }
    }
}
