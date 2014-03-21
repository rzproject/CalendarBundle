<?php


namespace Rz\CalendarBundle\Entity;

use Rz\CalendarBundle\Model\Category;


/**
 * Class BaseCategory
 * @package Rz\CalendarBundle\Entity
 */
abstract class BaseCategory extends Category
{
    /**
     *
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
    }

    /**
     *
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime;
    }
}