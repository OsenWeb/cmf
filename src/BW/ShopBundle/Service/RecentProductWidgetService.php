<?php

namespace BW\ShopBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Class RecentProductWidgetService
 * @package BW\ShopBundle\Service
 */
class RecentProductWidgetService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EngineInterface
     */
    private $templating;


    /**
     * @param EntityManager $em
     * @param $templating
     */
    public function __construct(EntityManager $em, EngineInterface $templating)
    {
        $this->em = $em;
        $this->templating = $templating;
    }


    /**
     * @param int $count The max results
     * @param string $template The template name to override default template
     * @return string The rendered template
     */
    public function show($count = 5, $template = 'BWShopBundle:RecentProductWidget:horizontal-scroll.html.twig')
    {
        $qb = $this->em->getRepository('BWShopBundle:Product')->createQueryBuilder('p');
        $qb
            ->addSelect('r')
            ->addSelect('pi')
            ->addSelect('i')
            ->innerJoin('p.route', 'r')
            ->leftJoin('p.productImages', 'pi')
            ->leftJoin('pi.image', 'i')
            ->where('p.published = 1')
            ->orderBy('p.created', 'DESC')
            ->setMaxResults($count)
        ;
        $entities = $qb->getQuery()->getResult();

        return $this->templating->render($template, [
            'entities' => $entities,
        ]);
    }
}
