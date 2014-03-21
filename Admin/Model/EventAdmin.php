<?php

namespace Rz\CalendarBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\CoreBundle\Model\ManagerInterface;

class EventAdmin extends Admin
{

    protected $eventManager;

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
            ->add('start', null, array('footable'=>array('attr'=>array('data_hide'=>'phone,tablet'))))
            ->add('end', null, array('footable'=>array('attr'=>array('data_hide'=>'phone,tablet'))))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('title')
            ->add('start')
            ->add('end')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('description')
            ->add('start')
            ->add('end')
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
            ->add('title')
            ->add('description')
            ->add('start')
            ->add('end')
        ;
    }

    /**
     * @param \Sonata\CoreBundle\Model\ManagerInterface $manager
     */
    public function setEventManager(ManagerInterface $manager)
    {
        $this->eventManager = $manager;
    }

    /**
     * @return \Sonata\CoreBundle\Model\ManagerInterface
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }
}
