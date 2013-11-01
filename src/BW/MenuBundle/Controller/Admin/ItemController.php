<?php

namespace BW\MenuBundle\Controller\Admin;

use BW\MainBundle\Controller\BWController;
use BW\MenuBundle\Entity\Item;
use BW\MenuBundle\Form\ItemType;

class ItemController extends BWController
{
    
    /**
     * @global \Symfony\Component\HttpFoundation\Request $request
     * @global \Symfony\Component\Form\Form $form
     * @global \Doctrine\ORM\EntityManager $em
     */
    public function __construct() {
        parent::__construct();
    }
    

    /**
     * Список всех пунктов меню
     * 
     * @return Response
     */
    public function itemsAction() {
        $data = $this->getPropertyOverload();
        $request = $this->get('request');
        
        $criteria = array();
        if ($request->query->getInt('menu_id')) {
            $criteria['menu'] = $request->query->getInt('menu_id');
        }
        
        $items = $this->getDoctrine()->getRepository('BWMenuBundle:Item')->findBy(
            $criteria,
            array(
                'ordering' => 'ASC',
            )
        );
        
        $recursion = new \BW\MenuBundle\Service\Recursion();
        $data->items = $recursion->levelParentEntityRecursion($items);
        
        return $this->render('BWMenuBundle:Admin/Item:items.html.twig', $data->toArray());
    }
    
//    public function addAction() {
//        $data = $this->getPropertyOverload();
//        $request = $this->get('request');
//        
//        $item = new Item();
//        $form = $this->createForm(new ItemAddType, $item);
//        
//        if ($request->isMethod('POST')) {
//            $form->handleRequest($request);
//            
//            if ($form->isValid()) {
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($item);
//                $em->flush();
//                                
//                if ($form->get('saveAndExit')->isClicked()) {
//                    return $this->redirect($this->generateUrl('admin_item_list', array('menu_id' => $item->getMenu()->getId())));
//                }
//                
//                return $this->redirect($this->generateUrl('admin_item_edit', array('id' => $item->getId())));
//            }
//        }
//        
//        $data->form = $form->createView();
//        return $this->render('BWMenuBundle:Admin/Item:item-add.html.twig', $data->toArray());
//    }
    
    /***
     * Создание нового пункта меню / Редактирование пункта меню по его ID
     * 
     * @return Response
     */
    public function itemAction($id = NULL) {
        $data = $this->getPropertyOverload();
        $request = $this->get('request');
        
        if ($id) {
            $item = $this->getDoctrine()->getRepository('BWMenuBundle:Item')->find($id);
        } else {
            $item = new Item();
        }
        
        $form = $this->createForm(new ItemType(), $item);
        if ( ! $id) {
            $form->remove('delete');
        }
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                if ($id) {
                    if ($form->get('delete')->isClicked()) {
                        $em->remove($item);
                        $em->flush();

                        return $this->redirect($this->generateUrl('admin_items'));
                    }
                }
                
                $em->persist($item);
                $em->flush();
                
                if ($form->get('saveAndExit')->isClicked()) {
                    return $this->redirect($this->generateUrl('admin_items', array('menu_id' => $item->getMenu()->getId())));
                }
                
                return $this->redirect($this->generateUrl('admin_item_edit', array('id' => $item->getId())));
            }
        }
        
        $data->form = $form->createView();
        if ($id) {
            return $this->render('BWMenuBundle:Admin/Item:item-edit.html.twig', $data->toArray());
        }
        
        return $this->render('BWMenuBundle:Admin/Item:item-add.html.twig', $data->toArray());
    }
    
    public function deleteAction($id) {
        
    }
}
