<?php

namespace BW\MenuBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Monolog\Logger;

/**
 * Class MenuWidgetService
 * @package BW\MenuBundle\Service
 */
class MenuWidgetService
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var EntityManager
     */
    private $em;


    /**
     * The constructor
     *
     * @param \Twig_Environment $twig
     * @param Logger $logger
     */
    public function __construct(EntityManager $em, \Twig_Environment $twig, Logger $logger)
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->logger = $logger;
        $this->logger->debug(sprintf(
            'Loaded service "%s".',
            __METHOD__
        ));
    }

    public function __toString()
    {
        return $this->show();
    }


    /**
     * Render the widget
     *
     * @param string $alias
     * @param string $template
     * @return string
     */
    public function show($alias = 'main_menu', $template = 'BWMenuBundle:MenuWidget:unordered-list.html.twig')
    {
        $menu = $this->em->getRepository('BWMenuBundle:Menu')->findOneBy([
            'alias' => $alias,
        ]);
        if (! $menu) {
            throw new \InvalidArgumentException(sprintf(
                'The Menu entity with alias "%s" not found',
                $alias
            ));
        }

        $repo = $this->em->getRepository('BWMenuBundle:Item');
        $query = $repo->createQueryBuilder('node')
            ->addSelect('r')
            ->leftJoin('node.route', 'r')
            ->orderBy('node.root, node.left', 'ASC')
            ->where('node.published = 1')
            ->andWhere('node.menu = :menu')
            ->setParameter('menu', $menu)
            ->getQuery();

        $repo->setChildrenIndex('children');
        $itemTree = $repo->buildTree($query->getArrayResult());

        return $this->twig->render($template, [
            'menu' => $menu,
            'itemTree' => $itemTree,
        ]);
    }
}
