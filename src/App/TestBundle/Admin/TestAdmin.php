<?php
namespace App\TestBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class TestAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by'    => 'id'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description')
            //->add('image', 'file', array('label' => 'Image', 'required' => false))
            // TODO: in etity append in field with path to image, type - a file (@Assert\File)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('created')
            ->add('image', 'string', array('template' => 'TestBundle:admin:list_image.html.twig'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

}