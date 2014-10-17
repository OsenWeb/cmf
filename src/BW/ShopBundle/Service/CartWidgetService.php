<?php

namespace BW\ShopBundle\Service;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Class CartWidgetService
 * @package BW\ShopBundle\Service
 */
class CartWidgetService
{
    /**
     * @var EngineInterface
     */
    private $templating;


    /**
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }


    /**
     * @param string $template
     */
    public function show($template = 'BWShopBundle:CartWidget:form.html.twig')
    {
    }
}
