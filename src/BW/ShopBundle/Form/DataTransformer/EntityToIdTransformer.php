<?php

namespace BW\ShopBundle\Form\DataTransformer;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use BW\ShopBundle\Entity\Entity;

/**
 * Class EntityToIdTransformer
 * @package BW\ShopBundle\Form\DataTransformer
 */
class EntityToIdTransformer implements DataTransformerInterface
{
    /**
     * @var EntityRepository
     */
    private $er;


    /**
     * @param EntityRepository $er
     */
    public function __construct(EntityRepository $er)
    {
        $this->er = $er;
    }


    /**
     * Transforms an object (entity) to an integer (id).
     *
     * @param  EntityToIdTransformerInterface|null $entity
     * @return integer
     */
    public function transform($entity)
    {
        if (null === $entity) {
            return null;
        }

        return $entity->getId();
    }

    /**
     * Transforms an integer (id) to an object (entity).
     *
     * @param integer $id
     * @return EntityToIdTransformerInterface|null
     * @throws TransformationFailedException if object (entity) is not found.
     */
    public function reverseTransform($id)
    {
        $id = (int)$id;

        if (0 >= $id) {
            return null;
        }

        $entity = $this->er->find($id);

        if (null === $entity) {
            throw new TransformationFailedException(sprintf(
                'An Entity "%s" with ID "%s" does not exist!',
                $this->er->getClassName(),
                $id
            ));
        }

        return $entity;
    }
}
