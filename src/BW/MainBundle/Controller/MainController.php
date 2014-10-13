<?php

namespace BW\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BWBlogBundle:Post')->findOneBy(array(
            'home' => TRUE,
            'published' => TRUE,
            'lang' => $this->get('bw_localization.lang')->getId(),
        ));

        return $this->render('BWMainBundle:Main:index.html.twig', array(
            'post' => $post,
        ));
    }

}
