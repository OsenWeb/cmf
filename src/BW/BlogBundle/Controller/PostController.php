<?php

namespace BW\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BW\MainBundle\Controller\BWController;

class PostController extends BWController
{
    

    public function postAction($slug) {
        $data = $this->getPropertyOverload();
        
        $lang = $this->get('bw.localization.lang')->getCurrentLangEntity();
        
        $data->post = $this->getDoctrine()->getRepository('BWBlogBundle:Post')->findOneBy(
            array(
                'slug' => $slug,
                'published' => TRUE,
                //'lang' => $lang,
            )
        );
        
        if ( ! $data->post) {
            throw $this->createNotFoundException('Ошибка 404. Запрашиваемая статья по адресу "'. $slug .'" не найдена. Скорее всего нужно перегенерировать ссылку страницы.');
        }
        
        return $this->render('BWBlogBundle:Post:post.html.twig', $data->toArray());
    }
}
