<?php

namespace BW\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CheckoutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderedProducts', 'collection', [
                'type' => new OrderedProductType(),
            ])
            ->add('delivery', 'entity', [
                'class' => 'BW\ShopBundle\Entity\Delivery',
                'property' => 'name',
                'label' => 'Доставка ',
            ])
            ->add('payment', 'entity', [
                'class' => 'BW\ShopBundle\Entity\Payment',
                'property' => 'name',
                'label' => 'Оплата ',
            ])
            ->add('recalculate', 'submit', [
                'label' => 'Пересчитать',
            ])
            ->add('checkout', 'submit', [
                'label' => 'Оформить заказ',
            ]);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BW\ShopBundle\Entity\Order',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bw_order';
    }
}
