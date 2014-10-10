<?php

namespace BW\ShopBundle\Controller;

use BW\CustomBundle\Entity\Property;
use BW\MainBundle\Utility\FormUtility;
use BW\ShopBundle\Entity\ProductField;
use BW\ShopBundle\Entity\Product;
use BW\ShopBundle\Entity\ProductImage;
use BW\ShopBundle\Form\ProductType;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ProductController
 * @package BW\ShopBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * Handle the filter form
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function filterRedirectAction(Request $request)
    {
        $filter = $this->get('bw_shop.service.product_filter');
        $form = $filter->createProductFilterForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $redirectUrl = $filter->generateUrl();

            return $this->redirect($redirectUrl);
        } else {
            die('Form invalid.');
        }
    }

//    /**
//     * Filter the product list
//     *
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
//     */
//    public function filterAction(Request $request, $filterQuery)
//    {
//        $filter = $this->get('bw_shop.service.product_filter');
//        $em = $this->getDoctrine()->getManager();
//
//        // Get array of property IDs from filter query string
//        $filterQuery = preg_replace('@\-\*(\?.*)?$@', '', $filterQuery); // remove asterisk sign (-*) with query string at the end
//        $ids = explode('-', $filterQuery);
//
//        // Get collection of entities from property IDs
//        $collection = $em->getRepository('BWCustomBundle:Property')->findBy(array(
//            'id' => $ids,
//        ));
//
////        $fields = array();
////        /** @var Property $entity */
////        foreach($collection as $entity) {
////            $fields[$entity->getField()->getId()][] = $entity->getId();
////        }
////        $content = '';
////        var_dump($fields);
////        foreach ($fields as $fieldId => $properties) {
////            foreach ($properties as $propertyId) {
////                $content .= "form[{$fieldId}][]={$propertyId}&";
////            }
////        }
////        $content .= 'form[apply]=';
//        /////////////////
//
//        $form = $filter->createProductFilterForm($collection);
//        /** @var QueryBuilder $qb */
//        $qb = $em->getRepository('BWShopBundle:Product')->createQueryBuilder('p');
//        $qb
//            ->where($qb->expr()->eq('p.published', true))
//            ->orderBy('p.created', 'ASC')
//        ;
//
//        $entities = $qb->getQuery()->getResult();
//
//        return $this->render('BWShopBundle:Product:list.html.twig', array(
//            'entities' => $entities,
//            'form' => $form->createView(),
//        ));
//    }

    /**
     * Lists all Category entities.
     */
    public function listAction($filterQuery)
    {
        $conn = $this->get('database_connection');
        $em = $this->getDoctrine()->getManager();

        // Get array of property IDs from filter query string
        $filterQuery = preg_replace('@\-\*(\?.*)?$@', '', $filterQuery); // remove asterisk sign (-*) with query string at the end
        $ids = explode('-', $filterQuery);

        /** @var array $collection Get collection of entities from property IDs */
        $properties = $em->getRepository('BWCustomBundle:Property')->findBy(array(
            'id' => $ids,
        ));

        $filter = $this->get('bw_shop.service.product_filter');
        $form = $filter->createProductFilterForm($properties);

        /** @var QueryBuilder $qb */
        $qb = $em->getRepository('BWShopBundle:Product')->createQueryBuilder('p');
        $qb
            ->addSelect('r')
            ->addSelect('c')
            ->addSelect('cr')
            ->addSelect('v')
            ->addSelect('vi')
            ->addSelect('pf')
            ->addSelect('f')
            ->addSelect('prop')
            ->addSelect('pi')
            ->addSelect('i')
            ->innerJoin('p.route', 'r')
            ->innerJoin('p.category', 'c')
            ->innerJoin('c.route', 'cr')
            ->leftJoin('p.vendor', 'v')
            ->leftJoin('v.image', 'vi')
            ->innerJoin('p.productFields', 'pf')
            ->innerJoin('pf.field', 'f')
            ->innerJoin('pf.properties', 'prop')
            ->leftJoin('p.productImages', 'pi')
            ->leftJoin('pi.image', 'i')
            ->where('p.published = 1')
            ->orderBy('p.created', 'ASC')
        ;

        // filter products by properties
        if ($properties) {
            /** @var QueryBuilder $qb2 */
            $qb2 = $em->getRepository('BWShopBundle:Product')->createQueryBuilder('p');
            $qb2
                ->select('p.id') // select only product ID column !
                ->innerJoin('p.route', 'r')
                ->innerJoin('p.category', 'c')
                ->innerJoin('c.route', 'cr')
                ->leftJoin('p.vendor', 'v')
                ->leftJoin('v.image', 'vi')

                ->innerJoin('p.productFields', 'pf')
                ->innerJoin('pf.field', 'f')
                ->innerJoin('pf.properties', 'prop')

                ->where('p.published = 1')
            ;

            /* Get array of product IDs */
            $propertyIds = [];
            $groupPropertyIds = [];
            /** @var Property $property */
            foreach ($properties as $property) {
                $propertyIds[] = $property->getId();
                $groupPropertyIds[$property->getField()->getId()][] = $property->getId();
            }

            /** @var Connection $conn */
            $query = $qb2->getQuery()->getSQL();
            $query .= " AND c8_.id IN (?)"; // filter by property IDs
            $query .= " GROUP BY s0_.id"; // group by product ID
            // filter by count of product-field IDs
            $query .= " HAVING COUNT(DISTINCT CONCAT_WS('-', s6_.product_id, s6_.field_id)) = ?";

            $stmt = $conn->executeQuery($query, [
                $propertyIds,
                count($groupPropertyIds),
            ], [
                Connection::PARAM_INT_ARRAY,
                \PDO::PARAM_INT,
            ]);
            $productIds = [];
            while ($row = $stmt->fetch(\PDO::FETCH_COLUMN)) {
                $productIds[] = $row;
            }
            /* /Get array of product IDs */

            $qb
                ->andWhere('p.id IN (:product_ids)')
                ->setParameter('product_ids', $productIds)
            ;
        }

        $entities = $qb->getQuery()->getResult(); // Collection of products

        return $this->render('BWShopBundle:Product:list.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
        ));
    }

    /**
     * Lists all Product entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BWShopBundle:Product')->findAll();

        return $this->render('BWShopBundle:Product:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Product entity.
     */
    public function createAction(Request $request)
    {
        $entity = new Product();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if ($form->get('addField')->isClicked()) {
                $field = $form->get('field')->getData();
                if ($field) {
                    $productField = new ProductField();
                    $productField->setProduct($entity);
                    $productField->setField($field);
                    $em->persist($productField);
                }
            }

            $em->persist($entity);
            $em->flush();

            if ($form->get('createAndClose')->isClicked()) {
                return $this->redirect($this->generateUrl('product'));
            }

            return $this->redirect($this->generateUrl('product_edit', array('id' => $entity->getId())));
        }

        return $this->render('BWShopBundle:Product:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Product entity.
     *
     * @param Product $entity The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Product $entity)
    {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('product_create'),
            'method' => 'POST',
        ));

        FormUtility::addCreateButton($form);
        FormUtility::addCreateAndCloseButton($form);

        return $form;
    }

    /**
     * Displays a form to create a new Product entity.
     */
    public function newAction()
    {
        $entity = new Product();
        $form   = $this->createCreateForm($entity);

        return $this->render('BWShopBundle:Product:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Product entity.
     */
    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var QueryBuilder $qb */
        $qb = $em->getRepository('BWShopBundle:Product')->createQueryBuilder('p');
        $qb
            ->addSelect('pi')
            ->addSelect('pii')
            ->addSelect('c')
            ->addSelect('cr')
            ->addSelect('v')
            ->addSelect('vi')
            ->leftJoin('p.productImages', 'pi')
            ->leftJoin('pi.image', 'pii')
            ->leftJoin('p.category', 'c')
            ->leftJoin('c.route', 'cr')
            ->leftJoin('p.vendor', 'v')
            ->leftJoin('v.image', 'vi')
            ->where('p.id = :id')
            ->andWhere('p.published = 1')
            ->setParameter('id', $id)
        ;
        /** @var Product $entity */
        $entity = $qb->getQuery()->getOneOrNullResult();

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $images = [];
        /** @var ProductImage $productImage */
        foreach ($entity->getProductImages() as $productImage) {
            $image = $productImage->getImage();

            $controller = $this->get('liip_imagine.controller');
            $cacheManager = $this->container->get('liip_imagine.cache.manager');
            $controller->filterAction($request, $image->getWebPath(), 'small_thumb');
            $controller->filterAction($request, $image->getWebPath(), 'middle_thumb');
            $controller->filterAction($request, $image->getWebPath(), 'large_thumb');

            $images[] = [
                'id' => $image->getId(),
                'filename' => $image->getFilename(),
                'title' => $image->getTitle(),
                'alt' => $image->getAlt(),
                'smallThumbPath' => $cacheManager->getBrowserPath($image->getWebPath(), 'small_thumb'),
                'middleThumbPath' => $cacheManager->getBrowserPath($image->getWebPath(), 'middle_thumb'),
                'largeThumbPath' => $cacheManager->getBrowserPath($image->getWebPath(), 'large_thumb'),
            ];
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BWShopBundle:Product:show.html.twig', array(
            'entity'      => $entity,
            'images'      => $images,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Product entity.
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BWShopBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BWShopBundle:Product:edit.html.twig', array(
            'entity' => $entity,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Product $entity The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Product $entity)
    {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('product_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        FormUtility::addUpdateButton($form);
        FormUtility::addUpdateAndCloseButton($form);
        FormUtility::addDeleteButton($form);

        return $form;
    }

    /**
     * Edits an existing Product entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BWShopBundle:Product')->find($id);
        if ( ! $entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if ($editForm->get('delete')->isClicked()) {
                $this->delete($id);
                return $this->redirect($this->generateUrl('product'));
            } elseif ($editForm->get('addField')->isClicked()) {
                $field = $editForm->get('field')->getData();
                if ($field) {
                    $productField = new ProductField();
                    $productField->setProduct($entity);
                    $productField->setField($field);
                    $em->persist($productField);
                }
            }

            $em->flush();

            if ($editForm->get('updateAndClose')->isClicked()) {
                return $this->redirect($this->generateUrl('product'));
            }

            return $this->redirect($this->generateUrl('product_edit', array('id' => $id)));
        }

        return $this->render('BWShopBundle:Product:edit.html.twig', array(
            'entity' => $entity,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    private function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BWShopBundle:Product')->find($id);

        if ( ! $entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $em->remove($entity);
        $em->flush();
    }

    /**
     * Deletes a Product entity.
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->delete($id);
        }

        return $this->redirect($this->generateUrl('product'));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
