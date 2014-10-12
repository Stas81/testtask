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
class CategoryAdmin extends Admin {
   
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            
            ->add('name', 'text', array('label' => 'Name', 'help' => 'Type new category name here (max. lenght - 255)'))
            ->add('description', 'textarea', array('label' => 'Description', 'help' => 'Provide short description for this category', 'required' => false))            
        ;
    }
    
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }
    
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', 'text', array('identifier' => true))
            ->add('description')
        ;
    }
}
