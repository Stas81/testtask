<?php
namespace Stas\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryAdmin
 *
 * @author develop1
 */
class ProductAdmin extends Admin {
    
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('General')
                    ->add('name', 'text', array('label' => 'Product Name'))
                    ->add('category', 'entity', array('class' => 'Stas\ProductBundle\Entity\Category'))
                    ->add('price', 'number', array('label' => "Product Price")) //if no type is specified, SonataAdminBundle tries to guess it
                ->end()
                ->with('Additional')
                    ->add('description', 'textarea', array('label' => 'Product Description', 'required' => false))
                ->end()
                
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('description')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name','text',array('identifier' => true))
            ->add('category', 'entity', array('class' => 'Stas\ProductBundle\Entity\Category'))
            ->add('price')
            ->add('description')
        ;
    }
}