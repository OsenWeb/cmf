<?php

namespace BW\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('published', 'checkbox', array(
                    'required' => FALSE,
                ))
                ->add('heading', 'text')
                ->add('shortDescription', 'textarea')
                ->add('content', 'textarea')
                ->add('created', 'datetime')
                // Entities
                // Category
                ->add('category', 'entity', array(
                    'class' => 'BWBlogBundle:Category',
                    'property' => 'heading',
                    'required' => FALSE,
                    'empty_value' => 'Без категории',
                ))
                // Lang
                ->add('lang', 'entity', array(
                    'class' => 'BWLocalizationBundle:Lang',
                    'property' => 'name',
                    'required' => FALSE,
                    'empty_value' => 'Выберите язык',
                ))
                // Meta tags
                ->add('slug', 'text')
                ->add('title', 'text')
                ->add('metaDescription', 'textarea')
                // Buttons
                ->add('save', 'submit')
                ->add('saveAndExit', 'submit')
                ->add('delete', 'submit')
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BW\BlogBundle\Entity\Post',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'post';
    }
}
