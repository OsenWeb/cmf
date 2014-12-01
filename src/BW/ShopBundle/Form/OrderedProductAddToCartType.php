<?php

namespace BW\ShopBundle\Form;

use BW\ShopBundle\Form\DataTransformer\EntityToIdTransformer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderedProductAddToCartType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var EntityManager $em */
        $em = $options['em'];
        // this assumes that the entity manager was passed in as an option
        $transformer = new EntityToIdTransformer($em->getRepository('BWShopBundle:Product'));

        $builder
            ->add('quantity', 'text', [
                'label' => 'Количество ',
            ])
            // add a normal text field, but add your transformer to it
            ->add(
                $builder->create('product', 'hidden', [
                ])->addModelTransformer($transformer)
            )
            ->add('add', 'submit', [
                'label' => 'Добавить в корзину',
                'attr' => [
                    'class' => 'add-to-cart-button',
                ],
            ]);
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'BW\ShopBundle\Entity\OrderedProduct'
            ))
            ->setRequired(array(
                'em',
            ))
            ->setAllowedTypes(array(
                'em' => 'Doctrine\Common\Persistence\ObjectManager',
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bw_ordered_product_add_to_cart';
    }
}
