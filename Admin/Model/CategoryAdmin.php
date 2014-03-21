<?php

namespace Rz\CalendarBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\CoreBundle\Model\ManagerInterface;

class CategoryAdmin extends Admin
{

    protected $categoryManager;

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
            ->add('color', null, array('footable'=>array('attr'=>array('data_hide'=>'phone,tablet'))))
            ->add('updatedAt', null, array('footable'=>array('attr'=>array('data_hide'=>'phone,tablet'))))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('color')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('color')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('color')
        ;
    }

    /**
     * @param \Sonata\CoreBundle\Model\ManagerInterface $manager
     */
    public function setCategoryManager(ManagerInterface $manager)
    {
        $this->categoryManager = $manager;
    }

    /**
     * @return \Sonata\CoreBundle\Model\ManagerInterface
     */
    public function getCategoryManager()
    {
        return $this->categoryManager;
    }
}
