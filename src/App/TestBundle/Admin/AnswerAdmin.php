<?php
namespace App\TestBundle\Admin;

use App\TestBundle\TestBundle;
use Proxies\__CG__\App\TestBundle\Entity\Test;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class AnswerAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by'    => 'id'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('text', 'text', array('label' => 'Answer Text', 'required' => true))
            //->add('question', 'choice', array('label' => 'Text', 'required' => true))
            //->add('type', 'choice', array('choices'=>array_flip(TestBundle::$questionType)))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('text')
            ->add('question')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('text')
            ->add('question')
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