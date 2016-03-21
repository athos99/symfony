<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lft')
            ->add('rgt')
            ->add('lvl')
            ->add('name')
            ->add('title')
            ->add('autoPath')
            ->add('description')
            ->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime')
            ->add('sortOrder')
            ->add('root')
            ->add('parent')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Dir'
        ));
    }
}
